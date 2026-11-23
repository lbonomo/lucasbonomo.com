(() => {
const playerIcons = {
  play: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M8 5v14l11-7z"></path></svg>',
  pause: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M6 5h4v14H6zm8 0h4v14h-4z"></path></svg>',
  volume: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M3 9v6h4l5 4V5L7 9H3z"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 9a5 5 0 0 1 0 6m3-9a9 9 0 0 1 0 12"></path></svg>',
  muted: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M3 9v6h4l5 4V5L7 9H3z"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m16 9 5 6m0-6-5 6"></path></svg>',
}

function formatTime(seconds) {
  if (!Number.isFinite(seconds) || seconds < 0) {
    return '--:--'
  }

  const minutes = Math.floor(seconds / 60)
  const remainingSeconds = String(Math.floor(seconds % 60)).padStart(2, '0')
  return `${minutes}:${remainingSeconds}`
}

function createButton(className, label, icon) {
  const button = document.createElement('button')
  button.type = 'button'
  button.className = `lb-sp-player__button ${className}`
  button.setAttribute('aria-label', label)
  button.innerHTML = icon
  return button
}

function createControls(player) {
  const controls = document.createElement('div')
  controls.className = 'lb-sp-player__controls'

  const playButton = createButton('lb-sp-player__play', 'Reproducir audio', playerIcons.play)
  const timeline = document.createElement('div')
  timeline.className = 'lb-sp-player__timeline'

  const progress = document.createElement('input')
  progress.className = 'lb-sp-player__progress'
  progress.type = 'range'
  progress.min = '0'
  progress.max = '0'
  progress.step = '0.1'
  progress.value = '0'
  progress.disabled = true
  progress.setAttribute('aria-label', 'Posición del audio')

  const time = document.createElement('div')
  time.className = 'lb-sp-player__time'

  const currentTime = document.createElement('span')
  currentTime.className = 'lb-sp-player__current'
  currentTime.textContent = '0:00'

  const separator = document.createElement('span')
  separator.className = 'lb-sp-player__separator'
  separator.textContent = '/'

  const durationTime = document.createElement('span')
  durationTime.className = 'lb-sp-player__duration'
  durationTime.textContent = '--:--'

  const volume = document.createElement('div')
  volume.className = 'lb-sp-player__volume'
  const muteButton = createButton('lb-sp-player__mute', 'Silenciar audio', playerIcons.volume)

  time.append(currentTime, separator, durationTime)
  timeline.append(progress, time)
  volume.append(muteButton)
  controls.append(playButton, timeline, volume)
  player.append(controls)
}

function initializePlayer(player) {
  if (player.dataset.lbSpPlayerInitialized) {
    return
  }

  const audio = player.querySelector('.lb-sp-player__audio, audio')
  if (!audio) {
    console.error('LB audio player needs an audio element.')
    return
  }

  audio.classList.add('lb-sp-player__audio')
  audio.controls = false
  audio.removeAttribute('controls')
  audio.tabIndex = -1

  let heading = player.querySelector('.lb-sp-player__heading')
  if (!heading) {
    heading = document.createElement('p')
    heading.className = 'lb-sp-player__heading'
    heading.textContent = 'Escuchá el artículo'
    player.prepend(heading)
  }

  if (!player.querySelector('.lb-sp-player__play')) {
    createControls(player)
  }

  const playButton = player.querySelector('.lb-sp-player__play')
  const progress = player.querySelector('.lb-sp-player__progress')
  const currentTime = player.querySelector('.lb-sp-player__current')
  const durationTime = player.querySelector('.lb-sp-player__duration')
  const volumeButton = player.querySelector('.lb-sp-player__mute')
  const volumeRange = player.querySelector('.lb-sp-player__volume-range')
  let status = player.querySelector('.lb-sp-player__status')

  if (!playButton) {
    console.error('LB audio player needs a play button.')
    return
  }

  player.dataset.lbSpPlayerInitialized = 'true'

  if (!status) {
    status = document.createElement('span')
    status.className = 'lb-sp-player__status'
    player.append(status)
  }
  status.setAttribute('role', 'status')
  status.setAttribute('aria-live', 'polite')

  playButton.type = 'button'

  function updatePlaybackState() {
    const isPlaying = !audio.paused && !audio.ended
    playButton.setAttribute('aria-label', isPlaying ? 'Pausar audio' : 'Reproducir audio')
    playButton.innerHTML = isPlaying ? playerIcons.pause : playerIcons.play
  }

  function updateProgress() {
    const hasDuration = Number.isFinite(audio.duration) && audio.duration > 0
    const currentSeconds = Number.isFinite(audio.currentTime) ? audio.currentTime : 0

    if (currentTime) {
      currentTime.textContent = formatTime(audio.currentTime)
    }
    if (durationTime) {
      durationTime.textContent = formatTime(audio.duration)
    }
    if (progress) {
      const progressPercent = hasDuration
        ? Math.round((Math.min(currentSeconds, audio.duration) / audio.duration) * 10000) / 100
        : 0
      progress.style.setProperty('--lb-sp-player-progress', `${progressPercent}%`)
      progress.max = hasDuration ? String(audio.duration) : '0'
      progress.value = hasDuration ? String(Math.min(currentSeconds, audio.duration)) : '0'
      progress.disabled = !hasDuration
      progress.setAttribute('aria-label', 'Posición del audio')
    }
  }

  let previousVolume = audio.volume || 1

  function updateVolume() {
    const isMuted = audio.muted || audio.volume === 0

    if (volumeButton) {
      volumeButton.type = 'button'
      volumeButton.setAttribute('aria-label', isMuted ? 'Activar sonido' : 'Silenciar audio')
      volumeButton.innerHTML = isMuted ? playerIcons.muted : playerIcons.volume
    }
    if (volumeRange) {
      volumeRange.min = '0'
      volumeRange.max = '1'
      volumeRange.step = '0.01'
      volumeRange.value = isMuted ? '0' : String(audio.volume)
      volumeRange.setAttribute('aria-label', 'Volumen')
    }
  }

  playButton.addEventListener('click', () => {
    if (!audio.paused) {
      audio.pause()
      return
    }

    const playback = audio.play()
    if (playback && typeof playback.catch === 'function') {
      playback.catch((error) => {
        status.textContent = 'No se pudo reproducir el audio.'
        console.error('LB audio playback failed.', error)
      })
    }
  })

  audio.addEventListener('play', () => {
    status.textContent = ''
    updatePlaybackState()
  })
  audio.addEventListener('pause', updatePlaybackState)
  audio.addEventListener('ended', () => {
    updatePlaybackState()
    updateProgress()
  })
  audio.addEventListener('timeupdate', updateProgress)
  audio.addEventListener('loadedmetadata', updateProgress)
  audio.addEventListener('durationchange', updateProgress)
  audio.addEventListener('error', () => {
    status.textContent = 'No se pudo cargar el audio.'
  })

  if (progress) {
    progress.addEventListener('input', () => {
      if (Number.isFinite(audio.duration) && audio.duration > 0) {
        audio.currentTime = Number(progress.value)
        updateProgress()
      }
    })
  }

  if (volumeButton) {
    volumeButton.addEventListener('click', () => {
      if (audio.muted || audio.volume === 0) {
        audio.volume = previousVolume
        audio.muted = false
      } else {
        previousVolume = audio.volume || 1
        audio.muted = true
      }
      updateVolume()
    })
  }

  if (volumeRange) {
    volumeRange.addEventListener('input', () => {
      const volume = Math.min(1, Math.max(0, Number(volumeRange.value)))
      audio.volume = volume
      audio.muted = volume === 0
      if (volume > 0) {
        previousVolume = volume
      }
      updateVolume()
    })
  }

  audio.addEventListener('volumechange', updateVolume)
  updatePlaybackState()
  updateProgress()
  updateVolume()
}

document.querySelectorAll('.lb-sp-player').forEach(initializePlayer)
})()
