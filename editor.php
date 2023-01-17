<?php 
include 'includes/header.php';
include('config/connectdb.php'); 


// load project data
if (isset($_GET['id']) && $_GET['id'] != "") {

  $id = $_GET['id'];
  $result = mysqli_query(
    $conn,
    "SELECT * FROM `template` WHERE  id=$id"
  );

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $data = $row['projectData'];
        $data = json_encode($data);
   
  }
}


//save data
if (isset($_POST['projectData'])) {
    $id = $_POST["id"];
      $projectData = $_POST['projectData'];
    print_r($projectData);
      //update 
      mysqli_query($conn, "UPDATE `template` SET `projectData` = '$projectData' where `id`='$id' ");
    
  }


?>

<link rel="stylesheet" href="./dist/css/grapes.min.css">
<script src="./dist/grapes.min.js"></script>
<script src="./dist/grapes.block.basic.js"></script>
<style>
    body,
    html {
        margin: 0;
    }
</style>
<div id="gjs"></div>


</div>


<script type="text/javascript">
    	const curUrl = window.location.href;
	const url = new URL(curUrl);
	const search_params = url.searchParams; 
	const tempId = search_params.get('id');


    var editor = grapesjs.init({

        container: '#gjs',
        height: '100vh',
        width: '100%',
        storageManager: { autoload: 0 },
        storageManager: {
            type: 'remote',
    stepsBeforeSave: 1,
    autoload: true,

        },

        styleManager: {
            sectors: [{
                name: 'General',
                open: false,
                buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom']
            }, {
                name: 'Flex',
                open: false,
                buildProps: ['flex-direction', 'flex-wrap', 'justify-content', 'align-items', 'align-content', 'order', 'flex-basis', 'flex-grow', 'flex-shrink', 'align-self']
            }, {
                name: 'Dimension',
                open: false,
                buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
            }, {
                name: 'Typography',
                open: false,
                buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-shadow'],
            }, {
                name: 'Decorations',
                open: false,
                buildProps: ['border-radius-c', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
            }, {
                name: 'Extra',
                open: false,
                buildProps: ['transition', 'perspective', 'transform'],
            }
            ],
        },

        plugins: ["gjs-blocks-basic"],
        pluginsOpts: {
            "gjs-blocks-basic": {
                /* ...options */
            }
        },





    });

    editor.Panels.addButton('options', [
        {
            id: 'save', className: 'fa fa-floppy-o icon-blank',
            command: 'save-db',
            attributes: { title: 'Save Template Into Database' }
        }
    ]);


    // save command to save into database
    const commands = editor.Commands;
    commands.add('save-db', editor => {
        window.onbeforeunload = null;
        
        // var html = editor.getHtml();
        // var css = editor.getCss();

        const projectData = JSON.stringify(editor.getProjectData());

        $.ajax({
            url: "editor.php",
            type: "post",
            data: { id:tempId,projectData:projectData },
            success: function (response) {
                alert("Saved");
            }
        });
    });


    editor.loadProjectData(JSON.parse(<?php  echo isset($data)? $data : "" ?>));




</script>