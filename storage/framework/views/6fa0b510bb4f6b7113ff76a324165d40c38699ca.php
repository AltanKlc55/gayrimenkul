
<?php $__env->startPush('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('../assets/libs/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('javascript'); ?>
    <script src='<?php echo e(asset("../assets/libs/datatables/js/jquery.dataTables.min.js")); ?>' type="text/javascript"></script>
    <script src='<?php echo e(asset("assets/libs/tinymce/tinymce.min.js")); ?>' type="text/javascript"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('breadcrump', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        #drop-area {
            border: 2px dashed #007bff;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
        }

        #drop-area:hover {
            background-color: #f8f9fa;
        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .image-preview {
            position: relative;
            display: inline-block;
        }

        .image-preview img {
            max-width: 150px;
            border-radius: 10px;
            border: 2px solid #ddd;
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <form action="<?php echo e(route('ilanlar.edit')); ?>" id="form" name="form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Detaylı Kayıt
                        </div>
                        <div class="prism-toggle">
                            <button class="btn btn-sm btn-primary-light" form="form" type="submit">Kaydet<i
                                    class="ri-save-line ms-2 d-inline-block align-middle"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group mb-3 col-md-6">
                                        <label>İlan Başlığı</label>
                                        <input type="text" name="baslik" value="<?php echo e($page['row']->name); ?>" id="baslik"
                                            required class="form-control answer-text" value="">
                                    </div>
                                    <input type="hidden" name="selected_values" id="selected_values" value="">
                                    <input type="hidden" name="id" id="id" value="<?php echo e($page['row']->id); ?>">

                                    <div class="form-group mb-3 col-md-6">
                                        <label>Yapı Kategorisi</label>
                                        <select class="select form-control" name="kategori" id="kategori">
                                            <?php $__currentLoopData = $page['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 col-md-6">
                                        <label>Yapı Fiyatlandırması</label>
                                        <select class="select form-control" name="fiyatlandirma" id="fiyatlandirma">
                                            <option>Seç..</option>
                                            <option value="">Seç..</option>
                                            <option value="satilik">Satılık</option>
                                            <option value="kiralik">Kiralık</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 col-md-6">
                                        <label>İlan Fiyatı</label>
                                        <input type="text" name="fiyat" id="fiyat" value="<?php echo e($page['row']->price); ?>" required
                                            class="form-control answer-text" value="">
                                    </div>

                                    <div class="form-group mb-3 col-md-12">
                                        <label>Adres</label>
                                        <textarea class="form-control" id="adress"
                                            name="adress"><?php echo e($page['row']->adress); ?></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="form-group mb-3 col-md-8">
                                            <label>Yapı Özellikleri</label>
                                            <select class="form-control" id="ozellikler" name="ozellikler">
                                                <?php $__currentLoopData = $page['estateprops']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($ep->id); ?>" icon="<?php echo e($ep->category_icon); ?>">
                                                        <?php echo e($ep->category_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group mt-4 col-md-4">
                                            <button type="button" id="ozellikEkle"
                                                class="w-100 btn btn-sm btn-primary">Özellik Ekle +</button>
                                        </div>
                                    </div>

                                    <div id="ozellik_alani" class="mt-3"></div>

                                    <div class="form-group mb-3 col-md-12">
                                        <label>İlan Açıklaması</label>
                                        <textarea id="ilan_icerik" name="ilan_icerik"
                                            class="tinymce"><?php echo e($page['row']->content); ?></textarea>
                                    </div>
                                    <input hidden type="text" name="props" id="props"
                                        value='<?php echo json_encode($page["row"]->property_properties, 15, 512) ?>'>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="container">
                                    <div id="form-container">
                                        <div class="form-group-wrapper mb-3"
                                            style="background: #ff992b21; padding: 15px; border-radius: 15px;">
                                            <div id="drop-area" class="bg-white">
                                                <p>Dosyaları buraya sürükleyin veya tıklayın</p>
                                                <input type="file" id="fileInput" name="fileInput[]" multiple
                                                    accept="image/*" class="d-none">
                                            </div>
                                            <div class="preview-container" id="preview"></div>
                                            <input hidden type="text" name="images_data" id="images_data"
                                                value='<?php echo json_encode($page["row"]->images, 15, 512) ?>'>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <?php $__env->startPush('javascript'); ?>
        <?php echo $__env->yieldContent('add_javascript'); ?>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
    const dropArea = document.getElementById("drop-area");
    const fileInput = document.getElementById("fileInput");
    const previewContainer = document.getElementById("preview");
    const errorMessageContainer = document.createElement("div");

    errorMessageContainer.classList.add("error-message");
    document.body.appendChild(errorMessageContainer);

    let addedFiles = new Set();
    let images = [];
    let imageFilenames = []; 

    try {
        let imagesData = $('#images_data').val() || "[]";
        imageFilenames = JSON.parse(imagesData);

        if (!Array.isArray(imageFilenames)) {
            console.error("Hata: imageFilenames bir dizi değil!", imageFilenames);
            imageFilenames = [];
        }
    } catch (error) {
        console.error("Görseller yüklenirken hata oluştu:", error);
        imageFilenames = [];
    }

    if (Array.isArray(imageFilenames) && imageFilenames.length > 0) {
        imageFilenames.forEach(filename => {
            if (filename && !addedFiles.has(filename)) {
                const imagePreview = createImageElement(filename, filename); // 📌 Resmi `/uploads/` klasöründen çek
                previewContainer.appendChild(imagePreview);
                addedFiles.add(filename);
            }
        });
    }

    // 📌 Drag & Drop Eventleri
    dropArea.addEventListener("click", () => fileInput.click());
    dropArea.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = "#f1f1f1";
    });
    dropArea.addEventListener("dragleave", () => {
        dropArea.style.backgroundColor = "#fff";
    });
    dropArea.addEventListener("drop", (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = "#fff";
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener("change", (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        [...files].forEach(file => {
            if (!file.type.startsWith("image/")) return;

            if (addedFiles.has(file.name)) {
                showError("Bu görsel zaten eklenmiş!");
                return;
            }

            addedFiles.add(file.name);
            images.push(file); // 📌 Base64 yerine dosya nesnesini saklıyoruz
            imageFilenames.push(file.name); // 📌 `images_data` için sadece dosya adını ekliyoruz

            const imagePreview = createImageElement(URL.createObjectURL(file), file.name);
            previewContainer.appendChild(imagePreview);
        });
    }

    function createImageElement(src, filename) {
        const imagePreview = document.createElement("div");
        imagePreview.classList.add("image-preview");

        const img = document.createElement("img");
        img.src = src;
        img.classList.add("img-thumbnail");

        const removeBtn = document.createElement("button");
        removeBtn.classList.add("remove-btn");
        removeBtn.innerHTML = "✖";
        removeBtn.onclick = () => {
            imagePreview.remove();
            images = images.filter(item => item.name !== filename);
            imageFilenames = imageFilenames.filter(name => name !== filename);
            addedFiles.delete(filename);
            updateImagesData();
        };

        imagePreview.appendChild(img);
        imagePreview.appendChild(removeBtn);
        return imagePreview;
    }

    function updateImagesData() {
        setTimeout(() => {
            $('#images_data').val(JSON.stringify(imageFilenames));
        }, 50);
    }

    function showError(message) {
        errorMessageContainer.innerText = message;
        errorMessageContainer.style.display = "block";

        setTimeout(() => {
            errorMessageContainer.style.display = "none";
        }, 3000);
    }
</script>



        <style>
            .error-message {
                position: fixed;
                top: 10px;
                right: 10px;
                background-color: red;
                color: white;
                padding: 10px;
                border-radius: 5px;
                display: none;
                z-index: 999;
            }
        </style>



        <script>
            var editor_config = {
                path_absolute: "/",
                selector: "textarea.tinymce",
                plugins: 'link image table code textcolor media contextmenu',
                theme: 'modern',
                height: 300,
                code_dialog_height: 200,
                contextmenu: "link image inserttable | cell row column deletetable",
                toolbar: "formatselect | bold italic  strikethrough table | forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code | link | image | media",
                relative_urls: false,
                file_browser_callback: function (field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no"
                    });
                }
            };

            tinymce.init(editor_config);
        </script>


        <script>
            $(document).ready(function () {
                let selectedPricing = "<?php echo e($page['row']->price_type); ?>";
                $("#fiyatlandirma").val(selectedPricing).change();
                let rawData = $('#props').val();
                console.log("Raw JSON String:", rawData);

                try {
                    let propertyProperties = JSON.parse(rawData);
                    console.log("Parsed JSON Object:", propertyProperties);

                    propertyProperties.forEach(item => {
                        console.log(item)
                        $("#ozellik_alani").append(`<div class="input-group mb-2" data-key="${item.key}" data-icon="${item.icon}">
                                                                                                        <span class="input-group-text">${item.name}</span>
                                                                                                        <input type="text" class="form-control ozellik-input" name="${item.name}" value="${item.value}" placeholder="${item.name} değeri girin">
                                                                                                        <button class="btn btn-danger kaldir" type="button">×</button>
                                                                                                      </div>`);
                    });

                } catch (error) {
                    console.error("JSON Parse Hatası:", error.message);
                }

                var ozellikDizisi = [];

                $("#ozellikEkle").click(function () {
                    var seciliOzellik = $("#ozellikler option:selected").text();
                    var seciliDeger = $("#ozellikler").val();
                    var seciliDegerIcon = $("#ozellikler option:selected").attr('icon');

                    if ($("#ozellik_alani").find("[data-key='" + seciliDeger + "']").length > 0) {
                        alert("Bu özellik zaten eklenmiş.");
                        return;
                    }

                    ozellikDizisi.push({
                        key: seciliDeger,
                        icon: seciliDegerIcon,
                        name: seciliOzellik,
                        value: ""
                    });

                    var ozellikHTML = `<div class="input-group mb-2" data-key="${seciliDeger}" data-icon="${seciliDegerIcon}">
                                                                                                        <span class="input-group-text">${seciliOzellik}</span>
                                                                                                        <input type="text" class="form-control ozellik-input" name="${seciliDeger}" placeholder="${seciliOzellik} değeri girin">
                                                                                                        <button class="btn btn-danger kaldir" type="button">×</button>
                                                                                                      </div>`;

                    $("#ozellik_alani").append(ozellikHTML);
                    $("#props").val(ozellikDizisi);
                });

                $("#ozellik_alani").on("click", ".kaldir", function () {
                    var key = $(this).parent().attr("data-key");
                    ozellikDizisi = ozellikDizisi.filter(item => item.key !== key);
                    $("#props").val(ozellikDizisi);
                    $(this).parent().remove();
                });

                $("#ozellik_alani").on("input", ".ozellik-input", function () {
                    var key = $(this).attr("name");
                    var value = $(this).val();
                    ozellikDizisi.forEach(item => {
                        if (item.key === key) {
                            item.value = value;
                        }
                    });
                });

            });
        </script>


<script>
    $(document).ready(function () {
        $("#form").submit(function (e) {

            var formData = new FormData(this);
            var ozellikler = [];
            var old_images = $('#images_data').val();
            $("#ozellik_alani .input-group").each(function () {
                var key = $(this).data("key");
                var icon = $(this).data("icon");
                var value = $(this).find("input").val();
                ozellikler.push({ key: key, value: value, icon: icon });
            });

            formData.append("props", JSON.stringify(ozellikler));

            var files = $("#fileInput")[0].files;
            for (var i = 0; i < files.length; i++) {
                formData.append("fileInput[]", files[i]);
            }

            formData.append("existingImages", JSON.stringify(old_images));

            $.ajax({
                url: "<?php echo e(route('ilanlar.edit')); ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert("Başarıyla kaydedildi!");
                    window.location.href = "<?php echo e(route('ilanlar.lists')); ?>";
                },
                error: function (xhr, status, error) {
                }
            });
        });
    });
</script>




    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\Modules/Ilanlar\Resources/views/edit.blade.php ENDPATH**/ ?>