<script src='{{asset("assets/libs/tinymce/tinymce.min.js")}}'  type="text/javascript"></script>
<script>
    tinymce.init({
        selector: ".tinymce",
        plugins: 'link image table code textcolor media contextmenu',
        theme: 'modern',
        height: 300,
        code_dialog_height: 200,
        contextmenu: "link image inserttable | cell row column deletetable",
        toolbar: "formatselect | bold italic  strikethrough table | forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code | link | image | media", file_browser_callback: RoxyFileBrowser

    });
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
    }
</script>