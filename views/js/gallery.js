document.addEventListener("DOMContentLoaded", function(event) { 
    // when document loaded
    // add event listeners for all hearts and comments on the site
    Array.from(document.getElementsByClassName('fa-heart')).forEach( (elem) => {
        elem.addEventListener('click', handleLike)
    })

    Array.from(document.getElementsByClassName('fa-comments')).forEach( (elem) => {
        elem.addEventListener('click', handleComment)
    })

    Array.from(document.getElementsByClassName('add-comment-button')).forEach( (elem) => {
        elem.addEventListener('click', getNewComment)
    })
})

function handleLike(e) {

    // geting photo id from the post
    const photoId = e.target.parentNode.parentNode.parentNode.getElementsByTagName('img')[0].id

    if (e.target.classList.contains('active-like')) {

        // add front view for like
        e.target.classList.remove('active-like')
        e.target.innerHTML = Number(e.target.innerHTML) - +1

        // remove record from the date base
        sendLike(photoId, 'gallery/removeLike')
    } else {

        // add front view for like
        e.target.classList.add('active-like')
        e.target.innerHTML = Number(e.target.innerHTML) + +1

        // add record to the data base
        sendLike(photoId, 'gallery/addLike')
    }
    e.stopPropagation()
    e.preventDefault()
}


function sendLike (photoId, path) {
    let XHR = new XMLHttpRequest()
    let data = new FormData()

    // adding data to the form
    data.append('photoId', photoId)

    // // get response from the server
    // XHR.addEventListener('load', (event) => {
    //     console.log(event.target.responseText)
    // })

    // send ajax request
    XHR.open('POST', path)
    XHR.send(data)
}

function handleComment(e) {
    if (e.target.classList.contains('active-comment')) {
        e.target.classList.remove('active-comment')
        e.target.parentNode.parentNode.getElementsByClassName('comments-container')[0].classList.remove('active-comments-container')
    } else {
        e.target.classList.add('active-comment')
        e.target.parentNode.parentNode.getElementsByClassName('comments-container')[0].classList.add('active-comments-container')
    }
    e.stopPropagation()
    e.preventDefault()
}

function sendComment (comment, photoId, owner) {
    let XHR = new XMLHttpRequest()
    let data = new FormData()

    // adding data to the form
    data.append('comment', comment)
    data.append('photoId', photoId)

    // get response from the server
    XHR.addEventListener('load', (event) => {
        console.log(event.target.responseText)
    })

    // send ajax request
    XHR.open('POST', 'gallery/addComment')
    XHR.send(data)
}

function getNewComment(e) {

    let comment = document.getElementById('comment-input').value

    if (comment.length > 0) {

        // add comment to the data base 
        const photoId = e.target.parentNode.parentNode.parentNode.parentNode.getElementsByTagName('img')[0].id
        sendComment(comment, photoId)

        // add comment to the front page
    }
}