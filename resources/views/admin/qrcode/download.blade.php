<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Woofio</title>
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            @page {
                margin-left: 0.8in;
                margin-right: 0.8in;
                margin-top: 1.2in;
                margin-bottom: 1.2in;
            }
            #qr-codes-container, #qr-codes-container * {
                visibility: visible;
            }
            #qr-codes-container {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
        .heading {
            font-size: 20px;
            font-weight: 600;
            text-decoration: none;
            color: black;
        }

    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row d-flex justify-content-center bg-light border p-2">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <a href="https://localizadorwoofio.com/admin/order/all" class="heading">Woofio Code Preview</a>
            <button class="btn btn-primary shadow-none printButton" onclick="printAndDownloadPDF()" disabled>Print & Download PDF</button>
        </div>
    </div>
    <div id="qr-codes-container" class="d-flex flex-wrap"></div>
</div>

<script>

    const codes = <?php echo json_encode($codes); ?>;
    const qrCodesContainer = document.getElementById("qr-codes-container");

    codes.forEach((data, index) => {
        // Create a container element for each QR code
        const qrCodeContainer = document.createElement("div");
        qrCodeContainer.classList.add("qr-code-container", "m-2");
        qrCodeContainer.id = `qr-code-${index}`;

        qrCodesContainer.appendChild(qrCodeContainer);

        // Create QR code
        const qrCode = new QRCodeStyling({
            width: 100,
            height: 100,
            margin: 0,
            type: "svg",
            data: 'https://localizadorwoofio.com/scan?scan_id=' + data.code,
            image: '/woofio_blue.svg',
            imageOptions: {
                crossOrigin: "anonymous",
                margin: 0
            }
        });

        // Append the QR code to the container
        qrCode.append(qrCodeContainer);
    });

        /*----------------------------
     Preloader
    ------------------------------ */
    $(window).on("load", function() {
        $('.printButton').removeAttr('disabled');
    });

    // Function to print and download PDF
    function printAndDownloadPDF() {
        window.print();
    }
</script>

<!-- Bootstrap JS (Optional, for responsiveness) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
