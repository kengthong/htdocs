<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body class="bodyWrapper">
        <main>
            <p>
                Home Page 2
            </p>

            <!-- <form action="add-item.php" method="post"> -->
                <button id="addItem" name="add-item">
                    Add a new item
                </button>
            <!-- </form> -->

            <div class="itemsWrapper">
                <div>
                    Item 1
                </div>
            </div>

            <form class="contact-form" action="add-item.php" method="post">
                <input type="text" name="name" placeholder="Full name">
                <textarea name="message" placeholder="Message"></textarea>
                <button type="submit" name="submit">Submit</button>
            </form>

            <script>
                var addItemBtn = document.getElementById("addItem")
                var baseUrl = "http://localhost:8080/";
                console.log("window.location.href = " , window.location.href);
                console.log("doc.location.href = " , document.location.href);
                addItemBtn.addEventListener('click', function() {
                    document.location.href=baseUrl + 'add-item/index.php';
                })
            </script>
        </main>
    </body>
</html>