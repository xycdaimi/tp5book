<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"A:\wamp64\www\phptp5\public/../application/admin\view\admin\book.html";i:1703512274;}*/ ?>
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
                    <div class="col-lg-2">
                        <button class="btn btn-success add-button" data-toggle="modal" data-target="#add-book-modal"><i class="bi bi-plus-lg"></i>添加图书</button>
                    </div>
                    <div class="col-lg-8">
                        <form method="get" id="search-form" action="searchBook">
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
                            <th>操作</th>
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
                            <td>
                                <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit-book-modal" name="<?php echo $table['isbn']; ?>"><i class="bi bi-pencil-square"></i>编辑</button>
                                <button class="btn btn-danger btn-delete" data-toggle="modal" data-target="#delete-book-modal" name="<?php echo $table['isbn']; ?>"><i class="bi bi-trash"></i>删除</button>
                            </td>
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

        <!-- 添加图书模态框 -->
        <div class="modal fade" id="add-book-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">添加图书</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-book-form">
                        <div class="form-item">
                            <label for="add-group"><span class="must">*</span>所属组</label>
                            <select name="add-group" id="add-group" class="form-control groups">
                                <option value="">请选择图书所属组</option>
                                <?php if(is_array($groups) || $groups instanceof \think\Collection || $groups instanceof \think\Paginator): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $option['type_name']; ?>"><?php echo $option['type_name']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-item">
                            <label for="add-name"><span class="must">*</span>书名</label>
                            <input type="text" name="add-name" id="add-name" class="form-control" placeholder="书名">
                        </div>
                        <div class="form-item">
                            <label for="add-author"><span class="must">*</span>作者</label>
                            <input type="text" name="add-author" id="add-author" class="form-control" placeholder="作者">
                        </div>
                        <div class="form-item">
                            <label for="add-press"><span class="must">*</span>出版社</label>
                            <input type="text" name="add-press" id="add-press" class="form-control" placeholder="出版社">
                        </div>
                        <div class="form-item">
                            <label for="add-price"><span class="must">*</span>价格(人民币)</label>
                            <input type="text" name="add-price" id="add-price" class="form-control" placeholder="价格(人民币)">
                        </div>
                        <div class="form-item">
                            <label for="add-count"><span class="must">*</span>数量(本)</label>
                            <input type="text" name="add-count" id="add-count" class="form-control" placeholder="数量(本)">
                        </div>
                        <div class="form-item">
                            <label for="add-isbn"><span class="must">*</span>ISBN号码</label>
                            <input type="text" name="add-isbn" id="add-isbn" class="form-control" placeholder="ISBN号码">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary add-book-button">添加</button>
                </div>
                </div>
            </div>
        </div>

        <!-- 编辑图书模态框 -->
        <div class="modal fade" id="edit-book-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">编辑图书</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-book-form">
                        <div class="form-item">
                            <label for="edit-group">所属组</label>
                            <select name="edit-group" id="edit-group" class="form-control groups">
                                <option value="">请选择图书所属组</option>
                                <?php if(is_array($groups) || $groups instanceof \think\Collection || $groups instanceof \think\Paginator): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $option['type_name']; ?>"><?php echo $option['type_name']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-item">
                            <label for="edit-name">书名</label>
                            <input type="text" name="edit-name" id="edit-name" class="form-control" placeholder="书名">
                        </div>
                        <div class="form-item">
                            <label for="edit-author">作者</label>
                            <input type="text" name="edit-author" id="edit-author" class="form-control" placeholder="作者">
                        </div>
                        <div class="form-item">
                            <label for="edit-press">出版社</label>
                            <input type="text" name="edit-press" id="edit-press" class="form-control" placeholder="出版社">
                        </div>
                        <div class="form-item">
                            <label for="edit-price">价格(人民币)</label>
                            <input type="text" name="edit-price" id="edit-price" class="form-control" placeholder="价格(人民币)">
                        </div>
                        <div class="form-item">
                            <label for="edit-count">数量(本)</label>
                            <input type="text" name="edit-count" id="edit-count" class="form-control" placeholder="数量(本)">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary edit-book-button">编辑</button>
                </div>
                </div>
            </div>
        </div>

        <!-- 删除图书模态框 -->
        <div class="modal fade" id="delete-book-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">删除图书</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>确定删除 <span id="delete-name"></span> 此书吗？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-book-button">删除</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/static/js/canvas-nest.min.js"></script>
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/popper.min.js"></script>
    <script src="/static/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/js/book.js"></script>
</body>
</html>