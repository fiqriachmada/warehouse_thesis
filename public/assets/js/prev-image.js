function previewImage(){
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}

function previewImageWarehouse(iteration) {
    const image = document.querySelector(`#image${iteration}`);
    const imgPreview = document.querySelector(`.img-preview${iteration}`);

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}

function previewImageProduct(iteration) {
    const image = document.querySelector(`#image${iteration}`);
    const imgPreview = document.querySelector(`.img-preview${iteration}`);

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}

function fillUpWarehouseImageUUID(iteration, uuid) {
    const warehouse_image_uuid = document.querySelector(`#warehouse_image_uuid_${iteration}`);
    warehouse_image_uuid.setAttribute('value', uuid);
}

function fillUpProductImageUUID(iteration, uuid) {
    const product_image_uuid = document.querySelector(`#product_image_uuid_${iteration}`);
    product_image_uuid.setAttribute('value', uuid);
}