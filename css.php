<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .alert_h1 {
        background: black;
        color: white;
        padding: 20px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        cursor: pointer;
        border-radius: 4px;
        z-index: 9999;
    }

    .form_design {
        width: 500px;
        min-height: 150px;
        height: auto;
        background: white;
        box-shadow: 10px 10px 30px gray;
        color: black;
        border-radius: 4px;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        flex-wrap: wrap;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        padding: 20px 20px 30px 20px;
    }

    .top_h1 {
        width: 100%;
        background: black;
        color: white;
        padding: 20px;
    }

    .form_design label {
        display: inline-block;
        padding: 10px 5px 10px 0px;
    }

    .form_design input {
        padding: 10px;
        width: 200px;
        outline: none;
    }

    .form_design input[type="submit"] {
        background: green;
        color: white;
        cursor: pointer;
        border: none;
        outline: none;
        position: relative;
        top: 13px;
    }

    .redirect_a {
        background: darkcyan;
        color: white;
        text-decoration: none;
        font-size: 20px;
        padding: 10px;
        border-radius: 2px;
        float: right;
        margin: 0px 10px;
    }
</style>