<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Site.css">
    <title>Header</title>
    
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        function openImageModal() {
            const modal = document.getElementById("imageModal");
            const span = document.getElementsByClassName("close")[0];
            const modalText = document.getElementById("modalText");

            // Call the JavaScript function to generate the text
            const text = generateModalText();
            modalText.innerHTML = text;

            // Display the modal
            modal.style.display = "block";

            // Close the modal when the user clicks on <span> (x)
            span.onclick = function () {
                modal.style.display = "none";
            }

            // Close the modal when the user clicks anywhere outside of the modal
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        function generateModalText() {
            // Replace this with your dynamic text generation logic
            //The logo is displayed
            text1 = "<img src='../Photos/EngineerIN_logo.png' alt='ECE Paris' style='width: 100%;'>"
            text2 = "<h2>EngineerIN: Social Media Professionnel de l'ECE Paris</h2><br>"
            text3 = "<p>Nous sommes une platforme de reseau social pour les etudiants de l'ECE Paris.</p>"
            text4 = "<p>Cree par un groupe de 4 etudiants, notre objectif est de faciliter la communication entre les etudiants et des employeurs potentiels. On peut y trouver des offres d'emplois, des evenements des entreprises que vous aimez mais surtout, vous pouvez generer votre propre profil.</p>"
            return text1 + text2 + text3 + text4;
        }
    </script>
</head>

<body>
    .menu
 
    input.menu_input name="menu" type="radio" id="btn1" checked=""
    label.menu_label for="btn1" 
      .fa.fa-bars
      .menu_text menu
    .menu_box
      .menu_list About Us
      .menu_list Contact Us
    input.menu_input name="menu" type="radio" id="btn2"
    label.menu_label for="btn2" 
      .fa.fa-user
      .menu_text users
    input.menu_input name="menu" type="radio" id="btn3"
    label.menu_label for="btn3" 
      .fa.fa-comments
      .menu_text chat
  
    input.menu_input name="menu" type="radio" id="btn4"
    label.menu_label for="btn4" 
      .fa.fa-cog
      .menu_text edit
a.box-item href="https://codepen.io/Anna_Batura/" target="_blank"
  svg class="rabbit" viewBox="0 0 600 600" version="1.2"
    path id="rabbit" d="m 335.94313,30.576451 c -9.79312,-0.146115 -17.39091,4.439466 -17.39091,13.789758 0,11.508038 -2.91019,60.415461 1.40532,76.238951 4.31553,15.82355 21.58583,38.97215 34.51834,54.67597 10.06946,12.22726 4.34772,41.69626 4.34772,56.0813 0,14.38499 -2.89751,25.9107 -8.65153,25.9107 -5.75402,0 -14.35971,5.75217 -20.11373,11.50612 -5.75395,5.75402 -11.51588,12.95631 -18.70841,7.20229 -7.19251,-5.75402 -20.15388,-11.49441 -43.16987,-15.80992 -23.01609,-4.31551 -61.84129,-0.0234 -86.29583,8.60763 -24.45458,8.63104 -76.25857,56.11061 -90.643535,77.6882 -14.385056,21.5775 -15.799189,87.73247 -14.36068,97.80193 1.438509,10.06953 -2.908267,17.28255 -10.100778,8.65153 -7.192459,-8.63104 -12.911438,-4.30381 -12.911438,-4.30381 0,0 -7.202292,14.37045 -7.202292,21.56298 0,7.19244 2.854564,14.36068 2.854564,14.36068 0,0 -11.506099,8.65056 -11.506099,14.40458 0,5.75397 11.515881,15.83044 18.708391,24.46146 7.192546,8.63097 31.651182,25.89997 41.720624,24.46148 10.069543,-1.43851 28.775063,-0.0121 35.967573,4.3038 7.19253,4.31551 24.44687,10.06761 46.02443,11.5061 21.57752,1.43851 81.97845,5.75307 97.80193,5.75307 15.82357,0 20.1675,-2.86435 27.35996,-10.05688 7.19253,-7.19245 -5.78527,-15.84115 -10.10079,-25.9107 -4.31551,-10.06946 14.40363,-7.16912 20.15765,-8.60763 5.75402,-1.43849 21.59424,-11.5061 31.66376,-11.5061 10.06953,0 8.6165,10.05589 21.56298,15.80993 12.94654,5.75393 31.63939,24.43902 46.02443,27.31602 14.38497,2.87695 47.47173,0.0121 58.97979,-4.30381 11.50797,-4.31551 10.06946,-14.37044 0,-21.56297 -10.06955,-7.19244 -34.50663,-20.16742 -38.82214,-27.35994 -4.31551,-7.19246 -5.74329,-15.81969 1.44924,-23.01224 7.19251,-7.19252 14.35876,-4.30292 25.86678,-10.05685 11.50806,-5.75402 15.80992,-23.04354 15.80992,-33.11301 0,-10.06953 1.36928,-21.01352 5.75307,-27.31602 3.67345,-5.28128 5.10015,-22.13212 5.30499,-33.64009 0.21874,-12.28864 -5.29329,-15.24871 -9.60881,-22.44122 -4.31543,-7.19246 4.30285,-17.25917 10.05687,-17.25917 5.75402,0 31.65108,-4.33602 41.72062,-8.65153 10.06946,-4.31546 20.16744,-23.03273 27.35995,-31.66377 7.19246,-8.63095 1.41799,-27.31512 -8.65154,-33.06907 -10.06954,-5.75402 -10.07746,-21.59431 -18.70841,-31.66377 -8.63103,-10.06953 -18.68507,-31.62961 -27.31604,-38.82213 -8.63101,-7.19253 -28.77502,-12.95535 -35.96755,-12.95535 -7.19253,0 -11.50612,9e-4 -11.50612,-5.75306 0,-5.75402 -1.44924,-12.9203 -1.44924,-25.86678 0,-12.94655 -16.24344,-68.464566 -37.3729,-102.149659 -4.40799,-7.027282 -11.5581,-5.405316 -20.15765,-2.898485 -5.69412,1.659863 -8.60761,4.35564 -8.60761,23.056136 0,18.700566 -11.50515,-0.03133 -17.25917,-10.100794 -5.75403,-10.069512 -15.86265,-21.58444 -28.80918,-24.461458 -2.42749,-0.539415 -4.76669,-0.800692 -7.02665,-0.834399 z"
</body>

</html>