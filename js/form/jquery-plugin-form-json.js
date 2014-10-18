/**
 * 依赖jquery.js
 * 序列号form表单为json数据
 * 表单元素命名：user.id,user.group.id
 * 转换为对象：{"user":{"id":1,"group":{"id":2}}}
 * 只支持3级
 */
(function($){  
    $.fn.serializeJson=function(){
    	
    	var nameToObject = function(name,value){
    		var res = {};
    		var arrN = name.split(".");
    		res[arrN[arrN.length-1]] = value;
    		for(i=arrN.length-2;i>=0;i--){
    			var o = {};
    			o[arrN[i]] = res;
    			res = o;
    		}
    		return res;
    	};
    	var setObject = function(serializeObj,name,value){
    		 if(serializeObj[name] && null != value){  
                 if($.isArray(serializeObj[name])){  
                     serializeObj[name].push(value);  
                 }else if((typeof value) != "object"){
                     serializeObj[name]=[serializeObj[name],value];  
                 }  
             }else{  
                 serializeObj[name]=value;   
             }
    		 return serializeObj;
    	};
    	
        var serializeObj={};  
        var array=this.serializeArray();  
        $(array).each(function(){
        	
            var n = this.name.split(".");
            
            if(n.length>=1){
            	var value = this.value;
            	if(n.length > 1){
            		value = {};
            	}
            	serializeObj = setObject(serializeObj,n[0],value)
            }
            if(n.length>=2){
            	var value = this.value;
            	if(n.length > 2){
            		value = {};
            	}
            	for(var o in serializeObj){
            		if(o == n[0]){
            			var _3_v = Object.clone(serializeObj[o]);
                		serializeObj[o]  = setObject(_3_v,n[1],value);
            		}
            	}
           }
            if(n.length==3){
            	var value = this.value;
            	for(var o in serializeObj){
            		if(o== n[0]){
            			var _2_v = Object.clone(serializeObj[o]);
            			for(var b in _2_v){
            				if(b == n[1]){
	            				var _3_v = Object.clone(_2_v[b]);
	            				var type = typeof _3_v;
	                    		if(type == "object" || type == "array"){
	                    			_2_v[b]  = setObject(_3_v,n[2],value);
	                    		}
            				}
            			}
            			serializeObj[o] = _2_v;
            		}
            	}
           }
        });  
        var form_object = this;
        //处理checkbox
        this.find("input[type='checkbox']").each(function(){
        	var name = $(this).attr("name");
        	var length = form_object.find("input[type='checkbox']"+"[name='"+name+"']").length;
        	if(length==1){
        		var val = eval("serializeObj."+name);
            	if(val==undefined){
            		eval("serializeObj."+name+"=false;");
            	}else{
            		eval("serializeObj."+name+"=true;");
            	}
        	}else{
        		var val = eval("serializeObj."+name);
            	if(val==undefined){
            		eval("serializeObj."+name+"='';");
            	}
        	}
        	
        });
        return serializeObj;  
    };  
})(jQuery);