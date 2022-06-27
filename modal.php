<style type="text/css">
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 999;
        overflow: auto;
        visibility:hidden;
        opacity: 0;
        transition: opacity 0.7s ease-in 0s;
    }
    .popup {
        top: 35%;
        left: 0;
        right: 0;       
        font-size: 14px;
        margin: auto;
        width: 80%;
        min-width: 200px;
        max-width: 600px;
        position: absolute;
        padding: 15px 20px;
        border: 1px solid #666;
        background-color: #fefefe;
        z-index: 1000;
        border-radius: 10px;
        font: 14px/18px 'Tahoma', Arial, sans-serif;
        box-shadow: 0 0px 14px rgba(0, 0, 0, 0.4);
    }
    .close {
        top: 10px;
        right: 10px;
        width: 32px;
        height: 32px;
        position: absolute;
        border: none;
        border-radius: 50%;
        background-color: rgba(0, 130, 230, 0.9);
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        cursor: pointer;
        outline: none;
    }
    .close:before {
        color: rgba(255, 255, 255, 0.9);
        content: "X";
        font-family:  Arial, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
        text-shadow: 0 -1px rgba(0, 0, 0, 0.9);
    }
    .close:hover {
        background-color: rgba(180, 20, 14, 0.8);
    }
    #overlay .popup p.zag{margin:20px 0 10px;padding:0 0 6px;color:tomato;font-size:16px;font-weight:bold;border-bottom:1px solid tomato;}
</style>
<script>
    var b = document.getElementById('overlay');
    function swa(){
        b.style.visibility = 'visible';
        b.style.opacity = '1';
        b.style.transition = 'all 0.7s ease-out 0s';
    }
    function swa2(){
        b.style.visibility = 'hidden';
        b.style.opacity = '0';
    }
</script>