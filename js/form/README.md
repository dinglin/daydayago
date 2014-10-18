
## jquery-plugin-form-json.js

      * 返回json对象，直接做ajax参数传递后台

          var obj =  $("#form").serializeJson();
      

      * input的`type=checkbox`时，只有一个时，格式化为`true`或`false`，多个时`空`或`数组`
