// Validation
const userName = document.getElementById('name')
const userEmail = document.getElementById('email')
const userGenre = document.getElementById('genre')
const userPassword = document.getElementById('password')
const userPasswordConfirmation = document.getElementById('passwordConfirmation')

// Find registration form and add onSubmit listener
const form = document.getElementById('form')
if (form) {
  form.addEventListener('submit', e => {
    const isFormValid = checkInputs()
    if (!isFormValid) {
      e.preventDefault()
    }
  })
}

// Find login form and add onSubmit listener
const form_login = document.getElementById('form-login')
if (form_login) {
  form_login.addEventListener('submit', e => {
    const isFormValid = checkInputs(false)
    if (!isFormValid) {
      e.preventDefault()
    }
  })
}

// Check inputs for validation
function checkInputs(isRegistation = true) {

  let isFormValid = true

  // trim to remove the whitespaces
  if (isRegistation) {
    const userNameValue = userName.value.trim()
    const userGenreValue = userGenre.value
    const passwordConfirmationValue = userPasswordConfirmation.value.trim()
    
    if(userNameValue === '') {
      setErrorFor(userName, 'Username cannot be blank')
      isFormValid = false
    } else {
      setSuccessFor(userName)
    }

    if(userGenreValue === '') {
      setErrorFor(userGenre, 'Select genre')
      isFormValid = false
    } else {
      setSuccessFor(userGenre)
    }

    if(passwordConfirmationValue === '') {
      setErrorFor(userPasswordConfirmation, 'passwordConfirmation cannot be blank')
      isFormValid = false
    } else if(passwordValue !== passwordConfirmationValue) {
      setErrorFor(userPasswordConfirmation, 'Passwords does not match')
      isFormValid = false
    } else{
      setSuccessFor(userPasswordConfirmation)
    }
  }

	const emailValue = userEmail.value.trim()
	const passwordValue = userPassword.value.trim()
	
	if(emailValue === '') {
    setErrorFor(userEmail, 'Email cannot be blank')
    isFormValid = false
	} else if (!isEmail(emailValue)) {
    setErrorFor(userEmail, 'Not a valid email')
    isFormValid = false
	} else {
		setSuccessFor(userEmail)
	}
	
	if(passwordValue === '') {
    setErrorFor(userPassword, 'Password cannot be blank')
    isFormValid = false
	} else {
		setSuccessFor(userPassword)
	}
	
  return isFormValid
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

// JQuery
// Fetch user books count and update counter element if exists
const fetchMyBooksCount = () =>
  $.ajax('count_user_books.php').done(response => {
    const myBooksCount = $('#myBooksCount')

    if (!myBooksCount) {
      return
    }

    myBooksCount.text(response)
  })

// Trigger adding a book, update counter and trigger callback 
const addUserBook = (id, callback) => $.ajax('add_user_book.php?id='+id).done(response => {
  fetchMyBooksCount()
  callback()
})

// Check when document is ready
$(document).ready(function() {
  console.log('Document is ready')
  // Fetch and update books counter
  fetchMyBooksCount()

  // Add listener to all ADD BOOK buttons
  $('.add-user-book-button').on('click', function (e) {
    e.preventDefault()
    const clickedElement = $(this)
    
    // Get book id from data-* attribute and call adding function, if success -> hide button
    addUserBook(clickedElement.data('bookid'), () => {
      clickedElement.hide()
    })
  })

  // Find.php
  // Parse url
  const params = new URLSearchParams(location.search)
  // Get category if exist, otherwise 'all'
  const category = params.get('category') || 'all'
  $('#categorySelector').val(category)

  // If category changed, refresh page with category accordingly
  $('#categorySelector').on('change',function() {
    const selector = $(this)
    location.href = 'find.php?category=' + selector.val()
  })

})
