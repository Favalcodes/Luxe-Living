$(function () {
  // Email Regex
  const emailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

  //   Variables
  const emailField = $('#email')
  const passwordField = $('#password')
  const password2Field = $('#password2')
  const usernameField = $('#username')

  //   Error Fields
  let emailError = $('.email-error')
  let passwordError = $('.password-error')
  let password2Error = $('.password2-error')
  let usernameError = $('.username-error')

  $('#registerForm').on('submit', e => {
    e.preventDefault()

    // Checking  Username Field
    if (usernameField.val().trim() === '') {
      usernameField.addClass('border-danger shake')
      usernameError.html('Username is required')
      return
    } else {
      clearInputErrors(usernameField)
      clearErrorMessage(usernameError)
    }

    // Checking  Email Address Field
    if (emailField.val().trim() === '') {
      emailField.addClass('border-danger shake')
      emailError.html('Email is required')
      return
    } else {
      clearInputErrors(emailField)
      clearErrorMessage(emailError)
    }

    // Checking Password Field
    if (passwordField.val().trim() === '') {
      passwordField.addClass('border-danger shake')
      passwordError.html('Password is required')
      return
    } else {
      clearInputErrors(passwordField)
      clearErrorMessage(passwordError)
    }

    // Checking Password Length
    if (passwordField.val().trim().length < 8) {
      passwordField.addClass('border-danger shake')
      passwordError.html('Password min length is 8')
      return
    } else {
      clearInputErrors(passwordField)
      clearErrorMessage(passwordError)
    }

    // Checking Password if password matches
    if (password2Field.val().trim() !== passwordField.val().trim()) {
      password2Field.addClass('border-danger shake')
      password2Error.html('Password does not match')
      return
    } else {
      clearInputErrors(password2Field)
      clearErrorMessage(password2Error)
    }

    // Checking Valid Email Address
    if (!emailRegex.test(emailField.val().trim())) {
      emailField.addClass('border-danger shake')
      emailError.html('Please enter a valid email address')
      return
    } else {
      clearInputErrors(emailField)
      clearErrorMessage(emailError)
    }

    // All Fields are complete, clear errors
    clearInputErrors(usernameField, emailField, passwordField, password2Field)
    clearErrorMessage(usernameField, emailField, passwordField, password2Field)

    // Form is valid for submission
    // Ajax Request
    const data = {
      username: usernameField.val().trim(),
      email: emailField.val().trim(),
      password: passwordField.val().trim(),
      confirm: password2Field.val().trim(),
      action: 'REGISTER',
    }

    $.ajax({
      url: 'scripts/auth.php',
      method: 'POST',
      data: data,
      cache: false,
      success: function (res) {
        alert(res)
      },
      error: function (e) {
        emailError.html('Network error, please try again')
      },
    })
  })
})

const clearInputErrors = (...fields) =>
  fields.forEach(field => field.removeClass('border-danger shake'))

const clearErrorMessage = (...errorFields) =>
  errorFields.forEach(error => error.html(''))
