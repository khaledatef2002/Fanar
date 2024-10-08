<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Watch view</title>
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default-new/css/bootcamp_style.css' ?>">


        <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .player {
            position: relative;
        }

        .video-back-btn {
            position: absolute;
            top: 50px;
            right: 50px;
            color: #fff;
            z-index: 111;
        }


        .watch-video,
        .e_btn {
            padding: 8px 16px;
            color: #fff;
            font-size: 13px;
            border: 1px solid #754FFE !important;
            font-weight: 500;
            background-color: #754FFE;
            border-radius: 4px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            -o-border-radius: 4px;
            transition: .3s;
            -webkit-transition: .3s;
            -moz-transition: .3s;
            -ms-transition: .3s;
            -o-transition: .3s;
            cursor: pointer;
        }

        .watch-video:hover,
        .e_btn:hover {
            color: white;
            background: #754FFE;
            box-shadow: 0px 1px 10px #754FFE80;
        }

        </style>

    </head>

    <body>
        <div class="player">
            <div class="video-back-btn e_btn">
                <a href="<?php echo site_url('addons/bootcamp/my_bootcamp/' . $class_details['bootcamp_id']); ?>"></a><?php echo get_phrase('back'); ?></a>
            </div>

            <video poster="" id="player" playsinline controls>
                <source src="<?php echo $resource_url ?>" type="video/mp4">
            </video>
        </div>

        <link rel="stylesheet" href="<?php echo base_url() . 'assets/global/plyr/plyr.css'; ?>">
        <script src="<?php echo base_url() . 'assets/global/plyr/plyr.js'; ?>"></script>
        <script>
        var player = new Plyr('#player');
        </script>

        <script>
        $(document).ready(function() {
            $('a').click(function(e) {
                e.preventDefault();
                alert()
            });
        });
        </script>
    </body>

</html>
