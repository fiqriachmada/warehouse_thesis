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

  const supplier_id = $('#supplier_id');
  if (supplier_id.length) {
    supplier_id.wrap('<div class="position-relative"></div>');
    supplier_id
      .select2({
        placeholder: 'Select Supplier',
        dropdownParent: supplier_id.parent()
      });
  }

  const product_id = $('#product_id');
  if (product_id.length) {
    product_id.wrap('<div class="position-relative"></div>');
    product_id
      .select2({
        placeholder: 'Select Product',
        dropdownParent: product_id.parent()
      });
  }

  // Vertical Wizard
  // --------------------------------------------------------------------

  const wizardPropertyListing = document.querySelector('#wizard-property-listing');
  if (typeof wizardPropertyListing !== undefined && wizardPropertyListing !== null) {
    // Wizard form
    const wizardPropertyListingForm = wizardPropertyListing.querySelector('#wizard-inbound-listing-form');
    // Wizard steps
    const wizardPropertyListingFormStep1 = wizardPropertyListingForm.querySelector('#personal-details');
    const wizardPropertyListingFormStep2 = wizardPropertyListingForm.querySelector('#property-details');
    const wizardPropertyListingFormStep3 = wizardPropertyListingForm.querySelector('#property-features');
    const wizardPropertyListingFormStep4 = wizardPropertyListingForm.querySelector('#property-area');
    const wizardPropertyListingFormStep5 = wizardPropertyListingForm.querySelector('#price-details');
    // Wizard next prev button
    const wizardPropertyListingNext = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-submit'));
    const wizardPropertyListingPrev = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-prev'));

    const validationStepper = new Stepper(wizardPropertyListing, {
      linear: true
    });

    const FormValidation1 = FormValidation.formValidation(wizardPropertyListingFormStep1, {
      fields: {
        product_id: {
          validators: {
            notEmpty: {
              message: 'Please enter product'
            }
          }
        },
        supplier_id: {
          validators: {
            notEmpty: {
              message: 'Please select supplier'
            }
          }
        },
        code: {
          validators: {
            notEmpty: {
              message: 'Please enter code'
            }
          }
        },
        price: {
          validators: {
            notEmpty: {
              message: 'Please enter price'
            }
          }
        },
        on_hand: {
          validators: {
            notEmpty: {
              message: 'Please enter stock on hand'
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
          rowSelector: '.col-sm-4, .col-sm-6'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
    }).on('core.form.valid', function () {
      let form = $(".form-submit-warehouse");
      form.attr('onsubmit', 'return true');
      form.submit();
    });
  }
})();
