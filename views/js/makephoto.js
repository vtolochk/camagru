// Global variables
let width = 600,
    height = 0,
    filter = 'none',
    streaming = false

// DOM Elements
const video = document.getElementById('video')
const canvas = document.getElementById('canvas')
const photos = document.getElementById('photos')
const photoButton = document.getElementById('photo-but')
const clearButton = document.getElementById('clear-but')
const filters = document.getElementById('filters')

// Get media stream
navigator.mediaDevices.getUserMedia({video: true, audio: false}
).then(function (stream) {
    // link to the video source
    video.srcObject = stream
    // Play the video
    video.play()
})

.catch ( function (err) {
    console.log(`error: ${err}`)
})


// Play when ready
video.addEventListener('canplay', function (e) {
    if (!streaming) {
        // set video canvas height
        height = video.videoHeight / (video.videoWidth / width)

        video.setAttribute('width', width)
        video.setAttribute('height', height)
        canvas.setAttribute('width', width)
        canvas.setAttribute('height', height)

        streaming = true
    }
}, false)

// Photo button event
photoButton.addEventListener('click', function (e) {
    takePicture()
    e.preventDefault()
})

//Filter event
filters.addEventListener('change', function(e) {
    // Set filter to chosen options
    filter = e.target.value
    // Set filter to video
    video.style.filter = filter
    e.preventDefault()
})

//Clear event
clearButton.addEventListener('click', function(e) {
    //Clear photos
    photos.innerHTML = ''
    //Change filter back to normal
    filter = 'none'
    // Set video filter
    video.style.filter = filter
    // Reset select list
    filters.selectedIndex = 0
})

// Take picture from canvas
function takePicture() {
    //create canvas
    const context = canvas.getContext('2d')
    if (width && height) {
        //set canvas props
        canvas.width = width
        canvas.height = height
        // Draw an image of the video
        context.drawImage(video, 0, 0, width, height)

        // create an image from the canvas
        const imgUrl = canvas.toDataURL('image/png')

        // Create img element
        const img = document.createElement('img')
        
        //Set img src
        img.setAttribute('src', imgUrl)

        // Set image filter
        img.style.filter = filter

        // add image to photos
        photos.appendChild(img)
    }
}