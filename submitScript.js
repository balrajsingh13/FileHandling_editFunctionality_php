<script type="text/javascript" language="javascript">

    function checkform()
    {
        var f = document.forms["theform"].elements;
        var cansubmit = true;

        for (var i = 0; i < f.length; i++) {
            if (f[i].value.length == 0) cansubmit = false;
        }

        if (cansubmit) {
            document.getElementById('submitbutton').disabled = false;
        }
    }

</script> 