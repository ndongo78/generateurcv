
<!DOCTYPE html>
<html>
<head>
    <style>
        *::selection{
            background-color: lightgreen;
            color: orange;
        }
        body{
            margin: 0px;
            padding: 0px;
        }
        #popup{
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
        }
        #popup_content{
            background-image: url("https://s-media-cache-ak0.pinimg.com/originals/61/89/e7/6189e7aeb11c3483ea1d81202e1b89b8.gif");
            margin: auto;
            padding: 20px;
            border: 6px solid green;;
            width: 45%;
            height: 70%;
        }
        #popup_content form *{
            display: block;
            margin: auto;
        }
        #close_popup{
            float: right;
            display: block;
        }
        #close_popup img{
            width: 20px;
            height: 25px;
        }
        #close_popup img::selection{
            display: none;
        }
        #close_popup:hover, #close_popup:focus{
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        #popup_content form input{
            font-size: 30px;
            outline: none;
            box-shadow: 3px 3px 3px orange;
            border-top-left-radius: 40%;
            border-bottom-right-radius: 40%;
            padding: 10px;
        }
        #popup_content form input[type="submit"]{
            cursor: pointer;
            background: limegreen;
            color: darkred;
        }
        #popup_content form input::placeholder{
            color: darkred;
            text-align: center;
            font-family: verdana;
        }
    </style>
</head>
<body>
<button id="show_popup">Show popup</button>
<div id="popup">
    <div id="popup_content">
        <span id="close_popup"><img src="https://cdn.pixabay.com/photo/2014/03/25/16/33/cancel-297373_960_720.png"/></span><br/>
        <form method="POST">
            <br/><input type="text" name="pseudo" placeholder="pseudo"/><br/>
            <input type="email" name="email" placeholder="email"/><br/>
            <input type="password" name="pass" placeholder="mot de passe"/><br/>
            <input type="password" name="pass2" placeholder="retapez mot de pass"/><br/>
            <input type="submit" name="register" value="Je m'inscris"/></form><br/>
        </form>
    </div>
</div>
<script>
    var popup = document.getElementById('popup');
    var show_popup = document.getElementById("show_popup");
    var close_popup = document.getElementById("close_popup");
    show_popup.onclick = function(){
        popup.style.display = "block";
    }
    close_popup.onclick = function(){
        popup.style.display = "none";
    }
    window.onclick = function(event){
        if(event.target == popup){
            popup.style.display = "none";
        }
    }
</script>
</body>
</html>