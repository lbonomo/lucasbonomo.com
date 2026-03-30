const config = window.lb19InfiniteScroll || null

function parseInteger(value, fallback = 0) {
	const parsed = Number.parseInt(value, 10)
	return Number.isNaN(parsed) ? fallback : parsed
}

function encodePayload(payload) {
	const params = new URLSearchParams()
	Object.entries(payload).forEach(([key, value]) => {
		params.append(key, String(value))
	})
	return params.toString()
}

async function loadMore(sentinel) {
	if (!config || !config.ajaxUrl || !config.nonce) {
		return
	}

	if (sentinel.dataset.loading === '1') {
		return
	}

	const nextPage = parseInteger(sentinel.dataset.nextPage, 0)
	const maxPages = parseInteger(sentinel.dataset.maxPages, 0)

	if (nextPage < 2 || (maxPages > 0 && nextPage > maxPages)) {
		sentinel.remove()
		return
	}

	sentinel.dataset.loading = '1'
	sentinel.classList.add('is-loading')

	const payload = {
		action: 'lb19_load_more_posts',
		nonce: config.nonce,
		paged: nextPage,
		postType: sentinel.dataset.postType || 'post',
		taxonomy: sentinel.dataset.taxonomy || '',
		termId: parseInteger(sentinel.dataset.termId, 0),
		author: parseInteger(sentinel.dataset.author, 0),
		search: sentinel.dataset.search || '',
		year: parseInteger(sentinel.dataset.year, 0),
		month: parseInteger(sentinel.dataset.month, 0),
		day: parseInteger(sentinel.dataset.day, 0),
	}

	try {
		const response = await fetch(config.ajaxUrl, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
			},
			body: encodePayload(payload),
		})

		if (!response.ok) {
			throw new Error('Request failed')
		}

		const data = await response.json()
		if (!data || !data.success || !data.data || !data.data.html) {
			sentinel.remove()
			return
		}

		sentinel.insertAdjacentHTML('beforebegin', data.data.html)

		if (data.data.has_more) {
			sentinel.dataset.nextPage = String(data.data.next_page)
		} else {
			sentinel.remove()
		}
	} catch (error) {
		sentinel.classList.add('has-error')
	} finally {
		sentinel.dataset.loading = '0'
		sentinel.classList.remove('is-loading')
	}
}

function initInfiniteScroll() {
	const sentinels = document.querySelectorAll('[data-lb-infinite="1"]')
	if (!sentinels.length || !('IntersectionObserver' in window)) {
		return
	}

	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					loadMore(entry.target)
				}
			})
		},
		{
			rootMargin: '300px 0px',
			threshold: 0.01,
		}
	)

	sentinels.forEach((sentinel) => observer.observe(sentinel))
}

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initInfiniteScroll)
} else {
	initInfiniteScroll()
}
