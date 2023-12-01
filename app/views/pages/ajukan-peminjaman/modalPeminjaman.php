<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {font-family: 'Poppins', sans-serif;}
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 300px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            /* display: inline-block; */
            text-align: center;
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 10px;
            width: 20%;
            font-family: 'Poppins', sans-serif;
        }

        /* The Close Button */
        .close {
            display: inline-block;
            width: 102px;
            height: 40px;
            text-align: center;
            border-radius: 100px;
            background-color: white;
            color: #FCD106;
            border: 1px solid var(--Main-Yellow, #FCD106);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 500;
        }

        .close:hover,
        .close:focus {
            background-color: #FCD106;
            color: #FFF;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    </head>
    <body>
        <h2>Modal Example</h2>
        <!-- Trigger/Open The Modal -->
        <button id="myBtn">Open Modal</button>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <img src="../../../../public/assets/box.svg">
                <h3>Peminjaman Berhasil</h3>
                <p>Silakan menuju ke ruang inventaris!</p>
                <button type="button" class="close">Baik</button><br>
            </div>
        </div>

        <script>
            // Get the modal
            var modal = document.getElementById("myModal");
            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            // When the user clicks the button, open the modal 
            btn.onclick = function() {
                modal.style.display = "block";
            }
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </body>
</html>
