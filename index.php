<!doctype html>
<style type="text/css">
	.done-true {
	  text-decoration: line-through;
	  color: grey;
	}
</style>

<html ng-app="todoApp">
  <head>
  	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
    <script src="app.js"></script>

  </head>
  <body>
    <h2>Todo</h2>
    <div ng-controller="TodoListController as todoList">
      <span>{{todoList.remaining()}} of {{todoList.todos.length}} remaining</span>
      [ <a href="" ng-click="todoList.archive()">archive</a> ]
      <ul class="unstyled">
        <li ng-repeat="todo in todoList.todos">
          <label class="checkbox">
            <input type="checkbox" ng-model="todo.done">
            <span class="done-{{todo.done}}">{{todo.text}}</span>
          </label>
        </li>
      </ul>
      <form ng-submit="todoList.addTodo()">
        <input type="text" ng-model="todoList.todoText"  size="30"
               placeholder="add new todo here">
        <input class="btn-primary" type="submit" value="add">
      </form>
    </div>
    <button onclick='alertTest()'> Alert</button>
    <button onclick='confirmTest()'> Confirm</button>
  </body>
</html>


<script type="text/javascript">
	angular.module('todoApp', [])
	  .controller('TodoListController', function() {
	    var todoList = this;
	    todoList.todos = [
	      {text:'learn AngularJS', done:true},
	      {text:'build an AngularJS app', done:false}];
	 
	    todoList.addTodo = function() {
	      todoList.todos.push({text:todoList.todoText, done:false});
	      todoList.todoText = '';
	    };
	 
	    todoList.remaining = function() {
	      var count = 0;
	      angular.forEach(todoList.todos, function(todo) {
	        count += todo.done ? 0 : 1;
	      });
	      return count;
	    };
	 
	    todoList.archive = function() {
	      var oldTodos = todoList.todos;
	      todoList.todos = [];
	      angular.forEach(oldTodos, function(todo) {
	        if (!todo.done) todoList.todos.push(todo);
	      });
	    };
	    
	  });
	  	    function alertTest() {
            Swal.fire(
                "查詢作業失敗", //標題 
                "您所輸入的序號不存在或是系統被玩壞了!", //訊息內容(可省略)
                "error" //圖示(可省略) success/info/warning/error/question
                //圖示範例：https://sweetalert2.github.io/#icons
            );
        }
        function confirmTest() {
            Swal.fire({
                title: "操作確認",
                text: "請點選你想按的按鈕",
                showCancelButton: true
            }).then(function(result) {
               if (result.value) {
                    Swal.fire("您按了OK");
               }
               else {
                   Swal.fire("您選擇了Cancel");
               }
            });
        }
</script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>