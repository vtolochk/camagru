document.addEventListener("DOMContentLoaded", function(event) { 
    document.getElementsByClassName('fa-heart')[0].addEventListener('click', handleLike)
    document.getElementsByClassName('fa-comments')[0].addEventListener('click', handleComment)
})

const like = document.getElementsByClassName('fa-heart')[0]
const comment = document.getElementsByClassName('fa-comments')[0]

function handleLike(e) {
    // console.log(like.classList) //add class active like
    e.stopPropagation()
    e.preventDefault()
}

function handleComment(e) {
    comment.style.color = 'white'
    comment.style.backgroundColor = '#00D5B6'
    e.stopPropagation()
    e.preventDefault()
}