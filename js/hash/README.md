

## jquery-plugin-hash.js

  * ʹ��

      * ע��һ��ajax��������ʵ���첽��������


    ```javascript
          $.hashAjax.register("get",dataUrl,function(data){
	        $("#content").html(data);
      },"html");
    ```
  	 * ����  
     ```javascript
        $.hashAjax.execute();
     ```

      *  ����

     ```
        var dataUrl = $(this).attr("href");

      $.hashAjax.request(dataUrl,{});

      e.preventDefault();
     ```

  * ˢ��  
  ```javascript
        $.hashAjax.reload();
        //���Դ�json������$.hashAjax.reload({"a":"b"})
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

