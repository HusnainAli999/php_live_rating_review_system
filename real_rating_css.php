<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            overflow-x: hidden;
        }

        .rating-front-h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .rating-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 2px 2px 30px gray;
        }

        .rating-container input::placeholder {
            color: gray;
        }

        .rating-container input {
            color: black;
        }

        .rating-container textarea {
            color: black;
        }

        .review {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        .review p {
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        .review p strong {
            font-weight: bold;
        }

        .review strong {
            position: relative;
            display: inline-block;
        }

        #review-text {
            height: 80px;
            overflow: hidden;
            resize: none;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .read-more-link,
        .read-less-link {
            color: blue;
            cursor: pointer;
            display: none;
        }

        .btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .rating-container input[name="name"] {
            padding: 10px;
            width: 250px;
            border: 1px solid gold;
            outline: none;
        }

        .rating-container textarea {
            outline: 1px solid gold;
            font-family: Arial, sans-serif;
        }

        .rating-container textarea:focus {
            outline: 1px solid gold;
        }

        .rating-container input[type="submit"] {
            padding: 10px;
            width: 200px;
            border: none;
            outline: none;
            cursor: pointer;
            color: white;
            background: goldenrod;
        }

        .rating-container input[type="submit"]:hover {
            background: gold;

        }

        #readMoreLink {
            background: rgb(0, 255, 0);
            padding: 5px;
            color: white;
            text-decoration: none;
        }

        .pagination .next_a {
            background: dodgerblue;
            color: white;
            padding: 5px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 5px;
        }

        .previous_a {
            background: dodgerblue;
            color: white;
            padding: 5px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 5px;
        }

        .pagination_counting_a {
            background: dodgerblue;
            color: white;
            padding: 5px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 5px;
        }

        .pagination {
            margin: 30px;
        }

        .rating {
            margin: 0px 0px 0px 0px;
            display: inline-block;
            margin-left: 10px;
            position: relative;
            top: 3px;
        }

        .same_rating_div {
            display: inline-block;
            margin-left: 20px;
        }

        .same_rating_div_span {
            position: relative;
            top: -5px;
            margin-left: 30px;
            display: inline-block;
            width: 200px;
            color: white;
            border-radius: 10px;
            background: rgb(28,28,28);
            padding: 10px
        }

        .review {
            margin-left: 20px;
        }

        .giver_name {
            margin-left: 22px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .giver_name strong {
            display: inline-block;
        }

        .total_rating_reviews_joint_div {
            margin: 20px;
        }

        .delete_review_form {
            display: inline-block;
        }

        #reviewText {
            display: inline-block;
            padding-bottom: 10px;
            display: inline-block;
            width: 50%;
            word-wrap: break-word;
        }

        .total_reviews {
            background: rgb(39, 39, 39);
            color: dodgerblue;
            border-radius: 50%;
            padding: 20px;
            font-size: 20px;
            width: 200px;
            text-align: center;
            float: right;
            margin-top: -15px;

        }

        .delete-review {
            background: red;
            border: none;
            outline: none;
            width: 170px;
            padding: 10px;
            color: white;
            font-size: 18px;
            border-radius: 3px;
            cursor: pointer;
            float: right;
            margin: 20px 20px 0px 0px;
        }

        .reply_show_div {
            background: goldenrod;
            color: white;
            padding: 10px;
            width: 300px;
            border-radius: 10px;
        }

        .reply_form {
            width: 400px;
            margin: 10px 0px 20px 30px;
        }

        .reply_form input[type="text"] {
            width: 200px;
            padding: 10px;
            outline: none;
        }

        .reply_form input[type="text"]::placeholder {
            color: black;
        }

        .reply_form textarea {
            width: 300px;
            padding: 10px;
        }

        .reply_form input[type="submit"] {
            padding: 10px;
            width: 200px;
            border: none;
            outline: none;
            cursor: pointer;
            background: red;
            color: white;
            margin-top: 10px;
        }

        .reply_button {
            color: white;
            width: 170px;
            padding: 10px;
            background: rgb(255, 94, 0);
            border: none;
            outline: none;
            cursor: pointer;
            border-radius: 3px;
            margin-top: 20px;
            margin-right: 20px;
            font-size: 18px;
            position: absolute;
            right: 200px;
            margin-top: -100px;
        }

        .reply_name {
            margin-bottom: 10px;
        }

        .fa-star {
            float: right;
            margin-left: 5px;
            color: gold
        }

        textarea {
            color: black;

        }

        .delete-reply {
            background: orange;
            padding: 5px;
            border: none;
            outline: none;
            margin: 5px;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
            width: 150px;
        }

        .delete-reply:hover {
            background: white;
            border: 1px solid orange;
            color: orange;

        }

        .update_review_form {
            background: rgb(49, 49, 49);
            height: 200px;
            width: 300px;
            margin-left: 20px;
            margin-bottom: 10px;
            display: none;
        }

        .update_review_form textarea {
            width: 100%;
            height: 150px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            padding: 10px;
            outline: none;
            border-radius: 10px;
            background: black;
            border: none;
            color: white;
        }

        .update_review_form button {
            width: 200px;
            color: white;
            background: dodgerblue;
            border: none;
            outline: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 3px;
            margin-left: 50%;
            transform: translateX(-50%);
            margin-top: 7px;
            transition: all 0.3s;
        }

        .update_review_form button:hover {
            background: black;
        }

        .update_for_reviews,
        .delete_for_reviews {
            width: 100px;
            color: white;
            background: dodgerblue;
            border: none;
            outline: none;
            padding: 7px;
            cursor: pointer;
            border-radius: 3px;
            margin-left: 20px;
            position: relative;
            top: -10px;
            transition: all 0.3s;
        }

        .delete_for_reviews {
            background: red;
        }

        .update_for_reviews:hover {
            background: transparent;
            border: 1px solid dodgerblue;
            color: dodgerblue;
            font-weight: bold;
        }

        .reply_form_update {
            background: transparent;
            height: 200px;
            width: 300px;
            margin-left: -10px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .reply_form_update textarea {
            width: 100%;
            height: 150px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            padding: 5px 0px 5px 5px;
            outline: none;
            border-radius: 5px;
            color: white;
        }

        .reply_form_update button {
            width: 200px;
            color: white;
            background: dodgerblue;
            border: none;
            outline: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 3px;
            margin-left: 50%;
            transform: translateX(-50%);
            transition: all 0.3s;
        }

        .reply_form_update button:hover {
            background: transparent;
            border: 1px solid dodgerblue;
            color: dodgerblue;
            font-weight: bold;
        }

        .update-reply {
            width: 100px;
            color: white;
            background: dodgerblue;
            border: none;
            outline: none;
            padding: 5px;
            cursor: pointer;
            border-radius: 3px;
            margin-left: 20px;
            transition: all 0.3s;
        }

        .no_review_p {
            text-align: center;
            margin-top: 100px;
            font-size: 20px;
            margin-bottom: 40px;
        }
    </style>