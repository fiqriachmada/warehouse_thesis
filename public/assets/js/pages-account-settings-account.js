/**
 * Account Settings - Account
 */

'use strict';

(function () {
  const formAccSettings = document.querySelector('#formAccountSettings');
  const deactivateAcc = document.querySelector('#formAccountDeactivation');
  const deactivateButton = deactivateAcc?.querySelector('.deactivate-account');

  if (formAccSettings) {
    const fv = FormValidation.formValidation(formAccSettings, {
      fields: {
        name: {
          validators: {
            notEmpty: {
              message: 'Please enter name'
            }
          }
        },
        email: {
          validators: {
            notEmpty: {
              message: 'Please enter email'
            },
            emailAddress: {
              message: 'The value is not a valid email address'
            }
          }
        },
        phone: {
          validators: {
            notEmpty: {
              message: 'Please enter phone number'
            },
            numeric: {
              message: 'The value is not a valid phone number'
            }
          }
        },
        pob: {
          validators: {
            notEmpty: {
              message: 'Please enter place of birth'
            }
          }
        },
        dob: {
          validators: {
            notEmpty: {
              message: 'Please enter date of birth'
            },
            date: {
              format: 'YYYY/MM/DD',
              message: 'The value is not a valid date'
            }
          }
        },
        address: {
          validators: {
            notEmpty: {
              message: 'Please enter address'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: '',
          rowSelector: '.col-md-6'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        // Submit the form when all fields are valid
        // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    });
  }

  if (deactivateAcc) {
    const fv = FormValidation.formValidation(deactivateAcc, {
      fields: {
        accountActivation: {
          validators: {
            notEmpty: {
              message: 'Please confirm you want to delete account'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: ''
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        fieldStatus: new FormValidation.plugins.FieldStatus({
          onStatusChanged: function (areFieldsValid) {
            areFieldsValid
              ? // Enable the submit button
                // so user has a chance to submit the form again
                deactivateButton.removeAttribute('disabled')
              : // Disable the submit button
                deactivateButton.setAttribute('disabled', 'disabled');
          }
        }),
        // Submit the form when all fields are valid
        // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    });
  }

  // Deactivate account alert
  const accountActivation = document.querySelector('#accountActivation');

  // Alert With Functional Confirm Button
  if (deactivateButton) {
    deactivateButton.onclick = function () {
      if (accountActivation.checked == true) {
        Swal.fire({
          text: 'Are you sure you would like to deactivate your account?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes',
          customClass: {
            confirmButton: 'btn btn-primary me-2',
            cancelButton: 'btn btn-label-secondary'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.value) {
            $.ajaxSetup({
              headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
          });
      
          $.ajax({
              url: "/ajax/deactivate-account",
              method: "post",
              processData: false,
              contentType: false,
              success: function(response) {
                let timerInterval;
                Swal.fire({
                  title: "Auto Logout!",
                  html: "I will close in <b></b> milliseconds.",
                  timer: 2000,
                  timerProgressBar: true,
                  customClass: {
                    confirmButton: 'btn btn-primary timer-confirm-btn',
                    denyButton: 'btn btn-label-secondary timer-deny-btn',
                    cancelButton: 'btn btn-label-danger timer-cancel-btn',
                  },
                  didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                      timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                  }
                }).then((result) => {
                  location.href = '/sign-out'
                });
              },
              error: function(xhr, status, error) {
              }
          });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              title: 'Cancelled',
              text: 'Deactivation Cancelled!!',
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
          }
        });
      }
    };
  }

  // CleaveJS validation

  const phoneNumber = document.querySelector('#phoneNumber'),
    zipCode = document.querySelector('#zipCode');
  // Phone Mask
  if (phoneNumber) {
    new Cleave(phoneNumber, {
      phone: true,
      phoneRegionCode: 'US'
    });
  }

  // Pincode
  if (zipCode) {
    new Cleave(zipCode, {
      delimiter: '',
      numeral: true
    });
  }

  // Update/reset user image of account page
  let accountUserImage = document.getElementById('uploadedAvatar');
  const fileInput = document.querySelector('.account-file-input'),
    resetFileInput = document.querySelector('.account-image-reset');

  if (accountUserImage) {
    const resetImage = accountUserImage.src;
    fileInput.onchange = () => {
      if (fileInput.files[0]) {
        accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
      }
    };
    resetFileInput.onclick = () => {
      fileInput.value = '';
      accountUserImage.src = resetImage;
    };
  }
})();

// Select2 (jquery)
$(function () {
  var select2 = $('.select2');
  // For all Select2
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        dropdownParent: $this.parent()
      });
    });
  }
});
