<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"A:\wamp64\www\phptp5\public/../application/admin\view\admin\overtime.html";i:1703477997;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>超时查询</title>
    <title>图书管理</title>
    <link rel="stylesheet" href="/static/css/back.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/static/css/pagination.css">
    <link rel="shortcut icon" href="/static/img/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="app">
        <div class="overtime">
            <div class="operate-pane">
                <div class="row">
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8">
                        <form id="search-form" method="get" action="searchOver">
                            <div class="search">
                                <input type="text" class="form-control" name="search-text" id="search-text" placeholder="ISBN号码">
                                <button type="submit" class="btn btn-primary btn-search" name="search-button" id="search-button">搜索</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
            </div>

            <div class="overtime-pane">
                <div id="overtime-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Id</th>
                            <th>书名</th>
                            <th>ISBN号码</th>
                            <th>借阅人</th>
                            <th>借阅人ID卡</th>
                            <th>借阅人手机</th>
                            <th>借阅时间</th>
                            <th>应归还时间</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?>
                            <tr>
                            <th><?php echo ++$p; ?></th>
                            <td class="name"><?php echo $table['name']; ?></td>
                            <td><?php echo $table['isbn']; ?></td>
                            <td><?php echo $table['username']; ?></td>
                            <td><?php echo $table['id_card']; ?></td>
                            <td><?php echo $table['phone']; ?></td>
                            <td><?php echo $table['time']; ?></td>
                            <td><?php echo $table['r_time']; ?></td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="page-box">
                    <div class="m-style pag-box"><?php echo $data->render(); ?></div>
                </div>
            </div>
        </div>
    </div>
    <script src="/static/js/canvas-nest.min.js"></script>
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/popper.min.js"></script>
    <script src="/static/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>