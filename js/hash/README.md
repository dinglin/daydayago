

## jquery-plugin-hash.js

  * 使用

      * 注册一个ajax请求，用以实现异步请求数据


    ```javascript
          $.hashAjax.register("get",dataUrl,function(data){
	        $("#content").html(data);
      },"html");
    ```
  	 * 启动  
     ```javascript
        $.hashAjax.execute();
     ```

      *  请求

     ```
        var dataUrl = $(this).attr("href");

      $.hashAjax.request(dataUrl,{});

      e.preventDefault();
     ```

  * 刷新  
  ```javascript
        $.hashAjax.reload();
        //可以传json参数，$.hashAjax.reload({"a":"b"})
  ```








A
B
B
B
B
B
B
B
B
B
B
B
B

