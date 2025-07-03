
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
            <form action="<?php echo e(route('ilanlar.store')); ?>" id="form" name="form" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" name="baslik" id="baslik" required
                                        class="form-control answer-text" value="">
                                </div>
                                <input type="hidden" name="selected_values" id="selected_values" value="">
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
                                        <option value="satilik">Satılık</option>
                                        <option value="kiralik">Kiralık</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3 col-md-6">
                                    <label>İlan Fiyatı</label>
                                    <input type="text" name="fiyat" id="fiyat" required class="form-control answer-text"
                                        value="">
                                </div>

                                <div class="form-group mb-3 col-md-12">
                                    <label>Adres</label>
                                    <textarea class="form-control" id="adress" name="adress">

                                    </textarea>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-md-8">
                                        <label>Yapı Özellikleri</label>
                                        <select class="form-control" id="ozellikler" name="ozellikler">
                                            <?php $__currentLoopData = $page['estateprops']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($ep->id); ?>" icon="<?php echo e($ep->category_icon); ?>">
                                                    <?php echo e($ep->category_name); ?></option>
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
                                    <textarea id="ilan_icerik" name="ilan_icerik" class="tinymce">

                                    </textarea>
                                </div>
                                <input hidden type="text" name="props" id="props" value="">
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

        const addedFiles = new Set();

        function handleFiles(files) {
            [...files].forEach(file => {
                if (!file.type.startsWith("image/")) return;

                if (addedFiles.has(file.name)) return;
                addedFiles.add(file.name);

                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => {
                    const imagePreview = document.createElement("div");
                    imagePreview.classList.add("image-preview");

                    const img = document.createElement("img");
                    img.src = reader.result;
                    img.classList.add("img-thumbnail");

                    const removeBtn = document.createElement("button");
                    removeBtn.classList.add("remove-btn");
                    removeBtn.innerHTML = "✖";
                    removeBtn.onclick = () => {
                        imagePreview.remove();
                        addedFiles.delete(file.name);
                    };

                    imagePreview.appendChild(img);
                    imagePreview.appendChild(removeBtn);
                    previewContainer.appendChild(imagePreview);
                };
            });
        }
    </script>


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
                e.preventDefault();
                var formData = new FormData(this);
                var ozellikler = [];

                $("#ozellik_alani .input-group").each(function () {
                    var key = $(this).data("key");
                    var icon = $(this).data("icon");
                    var value = $(this).find("input").val();
                    var name = $(this).find("input").attr('name');
                    ozellikler.push({key: key, value: value, icon: icon, name:name});
                });

                formData.append("props", JSON.stringify(ozellikler));


                var files = $("#fileInput")[0].files;
                for (var i = 0; i < files.length; i++) {
                    formData.append("fileInput[]", files[i]);
                }

                console.log(formData);

                

                $.ajax({
                    url: "<?php echo e(route('ilanlar.store')); ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        alert("Başarıyla kaydedildi!");
                        window.location.href = "<?php echo e(route('ilanlar.lists')); ?>";
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert("Hata oluştu!");
                    }
                });
            });
        });
    </script>

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\astok\Desktop\private_real_estate\Modules/Ilanlar\Resources/views/create.blade.php ENDPATH**/ ?>