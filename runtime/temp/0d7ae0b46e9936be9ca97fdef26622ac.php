<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"A:\wamp64\www\phptp5\public/../application/users\view\users\book.html";i:1703477904;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>图书管理</title>
    <link rel="stylesheet" href="/static/css/book.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/static/css/pagination.css">
    <link rel="shortcut icon" href="/static/img/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="app">
        <div class="book">
            <div class="operate-pane">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <form method="get" id="search-form" action="searchbook">
                            <div class="search">
                                <select name="search-type" id="search-type" class="form-control">
                                    <option value="group">组名</option>
                                    <option value="name">书名</option>
                                    <option value="author">作者</option>
                                    <option value="press">出版社</option>
                                    <option value="isbn">ISBN</option>
                                </select>
                                <input type="text" class="form-control" name="search-text" id="search-text">
                                <button type="submit" class="btn btn-primary btn-search">搜索</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
            </div>

            <div class="book-pane">
                <div id="book-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Id</th>
                            <th>组名</th>
                            <th>书名</th>
                            <th>作者</th>
                            <th>出版社</th>
                            <th>价格(人民币)</th>
                            <th>数量(本)</th>
                            <th>ISBN号码</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?>
                            <tr>
                            <th><?php echo ++$p; ?></th>
                            <td><?php echo $table['groups']; ?></td>
                            <td class="name"><?php echo $table['name']; ?></td>
                            <td><?php echo $table['author']; ?></td>
                            <td><?php echo $table['press']; ?></td>
                            <td><?php echo $table['price']; ?></td>
                            <td><?php echo $table['quantity']; ?></td>
                            <td><?php echo $table['isbn']; ?></td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="page-box">
                    <div class="m-style pag-box">
                        <?php echo $data->render(); ?>
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