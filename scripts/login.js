$(function () {
  // Email Regex
  const emailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

  //   Variables
  const emailField = $('#email')
  const passwordField = $('#password')

  //   Error Fields
  let emailError = $('.email-error')
  let passwordError = $('.password-error')

  $('#loginForm').on('submit', e => {
    e.preventDefault()

    // Checking  Email Address Field
    if (emailField.val() === '') {
      emailField.addClass('border-danger shake')
      emailError.html('Email is required')
      return
    } else {
      clearInputErrors(emailField)
      clearErrorMessage(emailError)
    }

    // Checking Password Field
    if (passwordField.val() === '') {
      passwordField.addClass('border-danger shake')
      passwordError.html('Password is required')
      return
    } else {
      clearInputErrors(passwordField)
      clearErrorMessage(passwordError)
    }

    // Checking Valid Email Address
    if (!emailRegex.test(emailField.val())) {
      emailField.addClass('border-danger shake')
      emailError.html('Please enter a valid email address')
      return
    } else {
      clearInputErrors(emailField)
      clearErrorMessage(emailError)
    }

    // All Fields are complete, clear errors
    clearInputErrors(emailField, passwordField)
    clearErrorMessage(emailError, passwordError)

    // Form is valid for submission
    // Ajax Request
    const data = {
      email: emailField.val(),
      password: passwordField.val(),
      action: 'LOGIN',
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
