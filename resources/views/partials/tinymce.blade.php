<script src='{{asset("assets/libs/tinymce/tinymce.min.js")}}'  type="text/javascript"></script>
<script>
    /*
    tinymce.init({
        selector: ".tinymce",
        plugins: 'link image table code textcolor media contextmenu',
        theme: 'modern',
        height: 300,
        code_dialog_height: 200,
        contextmenu: "link image inserttable | cell row column deletetable",
        toolbar: "formatselect | bold italic  strikethrough table | forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code | link | image | media", file_browser_callback: file_browser_callback

    });
    function file_browser_callback(field_name, url, type, win){
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = '?field_name=' + field_name;

        //var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
        });
    }
    function RoxyFileBrowser(field_name, url, type, win){
        var roxyFileman = '{{route('filemanager')}}?integration=tinymce4';

        if (roxyFileman.indexOf("?") < 0) {
            roxyFileman += "?type=" + type;
        } else {
            roxyFileman += "&type=" + type;
        }

        roxyFileman += '&input=' + field_name + '&value=' + win.document.getElementById(field_name).value;

        if(tinyMCE.activeEditor.settings.language){
            roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
        }

        tinyMCE.activeEditor.windowManager.open({
            file: roxyFileman,
            title: 'Roxy Fileman',
            width: 850,
            height: 650,
            resizable: "yes",
            plugins: "media",
            inline: "yes",
            close_previous: "no"
        }, {
            window: win,
            input: field_name
        });
        return false;
    } */

    var editor_config = {
        path_absolute : "/",
        selector: "textarea.tinymce",
        plugins: 'link image table code textcolor media contextmenu',
        theme: 'modern',
        height: 300,
        code_dialog_height: 200,
        contextmenu: "link image inserttable | cell row column deletetable",
        toolbar: "formatselect | bold italic  strikethrough table | forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code | link | image | media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

    tinymce.init(editor_config);
</script>