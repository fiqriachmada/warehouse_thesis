/**
 *  Form Wizard
 */

'use strict';

(function () {
  // Init custom option check
  window.Helpers.initCustomOptionCheck();

  const flatpickrRange = document.querySelector('.flatpickr'),
    phoneMask = document.querySelector('.contact-number-mask'),
    countrySelect = $('#country'),
    goods_handling_equipment = document.querySelector('#goods_handling_equipment');

  // Phone Number Input Mask
  if (phoneMask) {
    new Cleave(phoneMask, {
      phone: true,
      phoneRegionCode: 'US'
    });
  }

  if (flatpickrRange) {
    flatpickrRange.flatpickr();
  }

  const rack_id = $('#rack_id');
  if (rack_id.length) {
    rack_id.wrap('<div class="position-relative"></div>');
    rack_id
      .select2({
        placeholder: 'Select Rack',
        dropdownParent: rack_id.parent()
      });
  }

  const product_category_id = $('#product_category_id');
  if (product_category_id.length) {
    product_category_id.wrap('<div class="position-relative"></div>');
    product_category_id
      .select2({
        placeholder: 'Select Product Category',
        dropdownParent: product_category_id.parent()
      });
  }

  // Vertical Wizard
  // --------------------------------------------------------------------

  const wizardPropertyListing = document.querySelector('#wizard-property-listing');
  if (typeof wizardPropertyListing !== undefined && wizardPropertyListing !== null) {
    // Wizard form
    const wizardPropertyListingForm = wizardPropertyListing.querySelector('#wizard-product-listing-form');
    // Wizard steps
    const wizardPropertyListingFormStep1 = wizardPropertyListingForm.querySelector('#personal-details');
    const wizardPropertyListingFormStep2 = wizardPropertyListingForm.querySelector('#property-details');
    const wizardPropertyListingFormStep3 = wizardPropertyListingForm.querySelector('#property-features');
    const wizardPropertyListingFormStep4 = wizardPropertyListingForm.querySelector('#property-area');
    const wizardPropertyListingFormStep5 = wizardPropertyListingForm.querySelector('#price-details');
    // Wizard next prev button
    const wizardPropertyListingNext = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-next'));
    const wizardPropertyListingPrev = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-prev'));

    const validationStepper = new Stepper(wizardPropertyListing, {
      linear: true
    });

    // Personal Details
    const FormValidation1 = FormValidation.formValidation(wizardPropertyListingFormStep1, {
      fields: {
        name: {
          validators: {
            notEmpty: {
              message: 'Please enter product name'
            }
          }
        },
        product_category_id: {
          validators: {
            notEmpty: {
              message: 'Please enter product category'
            }
          }
        },
        rack_id: {
          validators: {
            notEmpty: {
              message: 'Please select rack'
            }
          }
        },
        'warehouse_image_one': {
          validators: {
              file: {
                  extension: 'jpeg,jpg,png',
                  type: 'image/jpeg,image/png',
                  maxSize: 5 * 1024 * 1024,
                  message: 'Please choose at least one image file (JPEG or PNG) with a maximum size of 5MB.'
              }
          }
        },
        'warehouse_image_two': {
          validators: {
              file: {
                  extension: 'jpeg,jpg,png',
                  type: 'image/jpeg,image/png',
                  maxSize: 5 * 1024 * 1024,
                  message: 'Please choose at least one image file (JPEG or PNG) with a maximum size of 5MB.'
              }
          }
        },
        'warehouse_image_three': {
          validators: {
              file: {
                  extension: 'jpeg,jpg,png',
                  type: 'image/jpeg,image/png',
                  maxSize: 5 * 1024 * 1024,
                  message: 'Please choose at least one image file (JPEG or PNG) with a maximum size of 5MB.'
              }
          }
        },
        'warehouse_image_four': {
          validators: {
              file: {
                  extension: 'jpeg,jpg,png',
                  type: 'image/jpeg,image/png',
                  maxSize: 5 * 1024 * 1024,
                  message: 'Please choose at least one image file (JPEG or PNG) with a maximum size of 5MB.'
              }
          }
        },
        'warehouse_image_five': {
          validators: {
              file: {
                  extension: 'jpeg,jpg,png',
                  type: 'image/jpeg,image/png',
                  maxSize: 5 * 1024 * 1024,
                  message: 'Please choose at least one image file (JPEG or PNG) with a maximum size of 5MB.'
              }
          }
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-6, .col-sm-12'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          //* Move the error message out of the `input-group` element
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      validationStepper.next();
    });

    // Property Details
    const FormValidation2 = FormValidation.formValidation(wizardPropertyListingFormStep2, {
      fields: {
        // * Validate the fields here based on your requirements
        sale_price: {
          validators: {
            notEmpty: {
              message: 'Please enter sale price'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-12'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      validationStepper.next();
    });

    // Property Features
    const FormValidation3 = FormValidation.formValidation(wizardPropertyListingFormStep3, {
      fields: {
        // * Validate the fields here based on your requirements
        weight: {
          validators: {
            notEmpty: {
              message: 'Please enter weight'
            },
            numeric: {
              message: 'Weight must be a number'
            }
          }
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-4'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      let imageOne = $('#image1')[0].files[0];
      let imageTwo = $('#image2')[0].files[0];
      let imageThree = $('#image3')[0].files[0];
      let imageFour = $('#image4')[0].files[0];
      let imageFive = $('#image5')[0].files[0];

      let formProduct = $('.form-submit-product');
      
      if ((imageOne == undefined && $('#image1').data('image-exists') === false) &&
            (imageTwo == undefined && $('#image2').data('image-exists') === false) &&
            (imageThree == undefined && $('#image3').data('image-exists') === false) &&
            (imageFour == undefined && $('#image4').data('image-exists') === false) &&
            (imageFive == undefined && $('#image5').data('image-exists') === false)) {
            alert('Please select at least one product image.');
        } else {
            formProduct.attr('onsubmit', 'return true');
            formProduct.submit();
        }
    });

    wizardPropertyListingNext.forEach(item => {
      item.addEventListener('click', event => {
        // When click the Next button, we will validate the current step
        switch (validationStepper._currentIndex) {
          case 0:
            FormValidation1.validate();
            break;

          case 1:
            FormValidation2.validate();
            break;

          case 2:
            FormValidation3.validate();
            break;

          default:
            break;
        }
      });
    });

    wizardPropertyListingPrev.forEach(item => {
      item.addEventListener('click', event => {
        switch (validationStepper._currentIndex) {
          case 2:
            validationStepper.previous();
            break;

          case 1:
            validationStepper.previous();
            break;

          case 0:

          default:
            break;
        }
      });
    });
  }
})();
