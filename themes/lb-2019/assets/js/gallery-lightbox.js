/**
 * Lightbox for native WordPress core/gallery blocks using the native <dialog> element.
 *
 * @package lb19
 */

const IMAGE_URL_PATTERN = /\.(avif|gif|jpe?g|png|svg|webp)(?:[?#].*)?$/i

const ICONS = {
	close: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M6 6l12 12M18 6L6 18"></path></svg>',
	prev: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 18l-6-6 6-6"></path></svg>',
	next: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 6l6 6-6 6"></path></svg>',
}

function getFullImageSrc(img) {
	if (img.dataset.lbFullSrc) {
		return img.dataset.lbFullSrc
	}

	if (img.dataset.fullUrl) {
		return img.dataset.fullUrl
	}

	const link = img.closest('a[href]')
	if (link && IMAGE_URL_PATTERN.test(link.getAttribute('href') || '')) {
		return link.href
	}

	return img.currentSrc || img.src
}

function getImageCaption(img, gallery) {
	const figure = img.closest('figure')
	if (!figure || figure === gallery) {
		return ''
	}

	const caption = figure.querySelector('figcaption')
	return caption ? caption.textContent.trim() : ''
}

function getGalleryImages(gallery) {
	return Array.from(gallery.querySelectorAll('img')).filter((img) => Boolean(img.currentSrc || img.src))
}

function enhanceGallery(gallery) {
	if (gallery.dataset.lbLightboxReady === 'true') {
		return
	}

	const images = getGalleryImages(gallery)
	if (images.length === 0) {
		return
	}

	images.forEach((img, index) => {
		const existingLink = img.closest('a')
		if (existingLink && gallery.contains(existingLink)) {
			existingLink.classList.add('lb-gallery-trigger')
			existingLink.dataset.lbGalleryTrigger = 'true'
			if (!existingLink.getAttribute('aria-label')) {
				const altText = img.getAttribute('alt')?.trim()
				existingLink.setAttribute(
					'aria-label',
					altText ? `Ampliar imagen: ${altText}` : `Ampliar imagen ${index + 1}`
				)
			}
			return
		}

		if (img.parentElement && img.parentElement.matches('button.lb-gallery-trigger')) {
			return
		}

		const trigger = document.createElement('button')
		trigger.type = 'button'
		trigger.className = 'lb-gallery-trigger'
		trigger.dataset.lbGalleryTrigger = 'true'

		const altText = img.getAttribute('alt')?.trim()
		trigger.setAttribute(
			'aria-label',
			altText ? `Ampliar imagen: ${altText}` : `Ampliar imagen ${index + 1}`
		)

		img.parentNode.insertBefore(trigger, img)
		trigger.appendChild(img)
	})

	gallery.dataset.lbLightboxReady = 'true'
}

function enhanceGalleries(root = document) {
	const galleries = root.querySelectorAll('.wp-block-gallery')
	galleries.forEach(enhanceGallery)
}

function createLightbox() {
	const dialog = document.createElement('dialog')
	dialog.className = 'lb-gallery-lightbox'
	dialog.setAttribute('closedby', 'any')
	dialog.setAttribute('aria-label', 'Visor de galería')

	dialog.innerHTML = `
		<div class="lb-gallery-lightbox__surface">
			<div class="lb-gallery-lightbox__topbar">
				<span class="lb-gallery-lightbox__counter" aria-live="polite"></span>
				<form method="dialog" class="lb-gallery-lightbox__close-form">
					<button type="submit" value="close" class="lb-gallery-lightbox__close" aria-label="Cerrar visor" autofocus>
						${ICONS.close}
					</button>
				</form>
			</div>
			<div class="lb-gallery-lightbox__stage">
				<button type="button" class="lb-gallery-lightbox__nav lb-gallery-lightbox__nav--prev" aria-label="Imagen anterior">
					${ICONS.prev}
				</button>
				<figure class="lb-gallery-lightbox__figure">
					<img class="lb-gallery-lightbox__image" src="" alt="" />
					<figcaption class="lb-gallery-lightbox__caption" hidden></figcaption>
				</figure>
				<button type="button" class="lb-gallery-lightbox__nav lb-gallery-lightbox__nav--next" aria-label="Imagen siguiente">
					${ICONS.next}
				</button>
			</div>
		</div>
	`

	document.body.appendChild(dialog)

	const imageEl = dialog.querySelector('.lb-gallery-lightbox__image')
	const captionEl = dialog.querySelector('.lb-gallery-lightbox__caption')
	const counterEl = dialog.querySelector('.lb-gallery-lightbox__counter')
	const prevBtn = dialog.querySelector('.lb-gallery-lightbox__nav--prev')
	const nextBtn = dialog.querySelector('.lb-gallery-lightbox__nav--next')

	let currentItems = []
	let currentIndex = 0

	function renderCurrent() {
		const item = currentItems[currentIndex]
		if (!item) {
			return
		}

		imageEl.src = item.src
		imageEl.alt = item.alt

		if (item.caption) {
			captionEl.textContent = item.caption
			captionEl.hidden = false
		} else {
			captionEl.textContent = ''
			captionEl.hidden = true
		}

		const hasMultiple = currentItems.length > 1
		prevBtn.hidden = !hasMultiple
		nextBtn.hidden = !hasMultiple
		counterEl.textContent = hasMultiple ? `${currentIndex + 1} / ${currentItems.length}` : ''
	}

	function showIndex(nextIndex) {
		if (currentItems.length === 0) {
			return
		}

		const total = currentItems.length
		currentIndex = ((nextIndex % total) + total) % total
		renderCurrent()
	}

	prevBtn.addEventListener('click', () => {
		showIndex(currentIndex - 1)
	})

	nextBtn.addEventListener('click', () => {
		showIndex(currentIndex + 1)
	})

	dialog.addEventListener('keydown', (event) => {
		if (currentItems.length < 2) {
			return
		}

		if (event.key === 'ArrowLeft') {
			event.preventDefault()
			showIndex(currentIndex - 1)
		} else if (event.key === 'ArrowRight') {
			event.preventDefault()
			showIndex(currentIndex + 1)
		}
	})

	dialog.addEventListener('close', () => {
		dialog.returnValue = ''
		imageEl.removeAttribute('src')
		imageEl.alt = ''
		captionEl.textContent = ''
		captionEl.hidden = true
		counterEl.textContent = ''
	})

	// Close when clicking the empty blurred area outside the image and controls
	// (also acts as the light-dismiss fallback for browsers without closedBy support).
	const isOutsideContent = (event) => {
		const target = event.target instanceof Element ? event.target : null
		if (!target) {
			return true
		}

		return !target.closest(
			'.lb-gallery-lightbox__image, .lb-gallery-lightbox__caption, .lb-gallery-lightbox__close, .lb-gallery-lightbox__nav, .lb-gallery-lightbox__counter'
		)
	}

	let pressedOutside = false
	dialog.addEventListener('pointerdown', (event) => {
		pressedOutside = isOutsideContent(event)
	})
	dialog.addEventListener('pointerup', (event) => {
		if (pressedOutside && isOutsideContent(event)) {
			dialog.close()
		}
		pressedOutside = false
	})

	return {
		open(items, startIndex) {
			currentItems = items
			currentIndex = Math.max(0, Math.min(startIndex, items.length - 1))
			renderCurrent()

			if (!dialog.open) {
				dialog.showModal()
			}
		},
	}
}

function initGalleryLightbox() {
	enhanceGalleries(document)

	let lightbox = null

	document.addEventListener('click', (event) => {
		const target = event.target instanceof Element ? event.target : null
		if (!target) {
			return
		}

		const gallery = target.closest('.wp-block-gallery')
		if (!gallery) {
			return
		}

		const trigger = target.closest('[data-lb-gallery-trigger="true"]')
		const clickedImg = target.closest('img') || trigger?.querySelector('img')
		if (!clickedImg || !gallery.contains(clickedImg)) {
			return
		}

		const images = getGalleryImages(gallery)
		const startIndex = images.indexOf(clickedImg)
		if (startIndex === -1) {
			return
		}

		event.preventDefault()
		event.stopPropagation()

		const items = images.map((img) => ({
			src: getFullImageSrc(img),
			alt: img.getAttribute('alt') || '',
			caption: getImageCaption(img, gallery),
		}))

		if (!lightbox) {
			lightbox = createLightbox()
		}

		lightbox.open(items, startIndex)
	})

	if (typeof MutationObserver !== 'undefined') {
		const observer = new MutationObserver((mutations) => {
			for (const mutation of mutations) {
				for (const node of mutation.addedNodes) {
					if (!(node instanceof Element)) {
						continue
					}
					if (node.matches('.wp-block-gallery')) {
						enhanceGallery(node)
					} else if (node.querySelector('.wp-block-gallery')) {
						enhanceGalleries(node)
					}
				}
			}
		})

		observer.observe(document.body, { childList: true, subtree: true })
	}
}

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initGalleryLightbox)
} else {
	initGalleryLightbox()
}
