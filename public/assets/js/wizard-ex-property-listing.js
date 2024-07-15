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

  const country_id = $('#country_id');
  if (country_id.length) {
    country_id.wrap('<div class="position-relative"></div>');
    country_id
      .select2({
        placeholder: 'Select Country',
        dropdownParent: country_id.parent()
      });
  }

  const warehouse_category_id = $('#warehouse_category_id');
  if (warehouse_category_id.length) {
    warehouse_category_id.wrap('<div class="position-relative"></div>');
    warehouse_category_id
      .select2({
        placeholder: 'Select Warehouse Type',
        dropdownParent: warehouse_category_id.parent()
      });
  }

  const goods_handling_equipment_list = [
    'Forklift',
    'Stacker',
    'Pallet Jack (Hand Pallet Truck)',
    'Conveyor Belt',
    'Racking Systems',
    'Washing Machine',
    'Overhead Crane',
    'Automated Guided Vehicles (AGVs)',
    'Reach Trucks',
    'Hand Trucks',
    'Pneumatic Tube Systems'
  ];
  if (goods_handling_equipment) {
    new Tagify(goods_handling_equipment, {
      whitelist: goods_handling_equipment_list,
      maxTags: 20,
      dropdown: {
        maxItems: 20,
        classname: 'tags-inline',
        enabled: 0,
        closeOnSelect: false
      }
    });
  }

  // Vertical Wizard
  // --------------------------------------------------------------------

  const wizardPropertyListing = document.querySelector('#wizard-property-listing');
  if (typeof wizardPropertyListing !== undefined && wizardPropertyListing !== null) {
    // Wizard form
    const wizardPropertyListingForm = wizardPropertyListing.querySelector('#wizard-property-listing-form');
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
              message: 'Please enter warehouse name'
            }
          }
        },
        warehouse_category_id: {
          validators: {
            notEmpty: {
              message: 'Please enter warehouse type'
            }
          }
        },
        country: {
          validators: {
            notEmpty: {
              message: 'Please select country'
            }
          }
        },
        city: {
          validators: {
            notEmpty: {
              message: 'Please enter city'
            }
          }
        },
        zip_code: {
          validators: {
            notEmpty: {
              message: 'Please enter zip code'
            },
            stringLength: {
              min: 4,
              max: 10,
              message: 'The zip code must be more `than 4 and less than 10 characters long'
            }
          }
        },
        address: {
          validators: {
            notEmpty: {
              message: 'Please enter address'
            },
            stringLength: {
              min: 6,
              message: 'Address must be more than 6 characters long'
            }
          }
        },
        'warehouse_image[]': {
          validators: {
              file: {
                  extension: 'jpeg,jpg,png',
                  type: 'image/jpeg,image/png',
                  maxSize: 5 * 1024 * 1024,
                  minFiles: 1,
                  message: 'Please choose at least one image file (JPEG or PNG) with a maximum size of 5MB.'
              }
          }
        },
        'edit_warehouse_image[]': {
          validators: {
              file: {
                  extension: 'jpeg,jpg,png',
                  type: 'image/jpeg,image/png',
                  maxSize: 5 * 1024 * 1024,
                  minFiles: 1,
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
          rowSelector: '.col-sm-6, .col-sm-4, .col-lg-12'
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

        capacity: {
          validators: {
            notEmpty: {
              message: 'Please enter capacity'
            },
            numeric: {
              message: 'Capacity must be a number'
            }
          }
        },
        surface_area: {
          validators: {
            notEmpty: {
              message: 'Please enter surface area'
            },
            numeric: {
              message: 'Surface area must be a number'
            }
          }
        },
        building_area: {
          validators: {
            notEmpty: {
              message: 'Please enter building area'
            },
            numeric: {
              message: 'Building area must be a number'
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
          rowSelector: function (field, ele) {
            // field is the field name & ele is the field element
            switch (field) {
              case 'plAddress':
                return '.col-lg-12';
              default:
                return '.col-sm-4';
            }
          }
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
        storage_shelves: {
          validators: {
            notEmpty: {
              message: 'Please enter storage shelves'
            },
            numeric: {
              message: 'Storage shelves must be a number'
            }
          }
        },
        toilet_and_rest_area: {
          validators: {
            notEmpty: {
              message: 'Please enter toilet and rest area'
            },
            numeric: {
              message: 'Toilet and rest area must be a number'
            }
          }
        },
        effective_lighting_system: {
          validators: {
            notEmpty: {
              message: 'Please enter effective lighting system'
            }
          }
        },
        advanced_security_system: {
          validators: {
            notEmpty: {
              message: 'Please enter advanced security system'
            }
          }
        },
        electricity: {
          validators: {
            notEmpty: {
              message: 'Please enter electricity'
            },
            numeric: {
              message: 'Electricity must be a number'
            }
          }
        },
        administrative_room_or_office: {
          validators: {
            notEmpty: {
              message: 'Please enter administrative room or office'
            }
          }
        },
        worker_safety_equipment: {
          validators: {
            notEmpty: {
              message: 'Please enter worker safety equipment'
            }
          }
        },
        firefighting_tools: {
          validators: {
            notEmpty: {
              message: 'Please enter firefighting tools'
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
          rowSelector: '.col-sm-6, .col-lg-12'
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

      let formProduct = $('.form-submit-warehouse');
      
      if (imageOne == undefined && imageTwo == undefined && imageThree == undefined && imageFour == undefined && imageFive == undefined) {
          alert('Please select at least one warehouse image.');
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
