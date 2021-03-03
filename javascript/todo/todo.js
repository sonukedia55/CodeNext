
    let todos = [];


    function changeStatus(id,status){
      let notifyText = ""
      let notifyStatus = (status)?'completed':'pending';
      todos.forEach((i,ind)=>{ if(i.id==id){i.status = status;notifyText = `${i.todo} is marked as ${notifyStatus}!`;} });
      emitter.emit('todochanged', {todos: todos,message : notifyText});
      return
    }

    function deleteTodo(evt){
      const e =  evt.currentTarget
      let pId = e.getAttribute('data-id');

      todos = todos.filter(i=>{return i.id != pId});
      emitter.emit('todochanged', {todos: todos);
      e.parentNode.parentNode.removeChild(e.parentNode);
    }

    function switchCheck(evt){
      const e =  evt.target
      let pId = e.getAttribute('data-id');
      let elm = document.getElementById(`d${pId}`);
      let elmTodo = e.parentNode.getElementsByClassName("tdo")[0];
      console.log(elmTodo);
      if(elmTodo.classList.contains("stout")){
        elmTodo.classList.remove("stout");
      }else{
        elmTodo.classList.add("stout");
      }
      changeStatus(pId,e.checked);
    }


    const deleteButton = ({id}) => {
      let aDelete = document.createElement('a');
      aDelete.setAttribute('id',`de${id}`);
      aDelete.setAttribute('data-action','delete');
      aDelete.onclick = deleteTodo.bind(aDelete);
      aDelete.setAttribute('data-id',id);
      aDelete.innerHTML = `<i class="fa fa-close">X</i>`;
      return aDelete;
    }

    const checkBoxAdd = ({id,status}) => {
      let checkBox = document.createElement('input');
      checkBox.setAttribute('id',`d${id}`);
      checkBox.setAttribute('data-id',id);
      checkBox.setAttribute('type',`checkbox`);
      checkBox.onchange = switchCheck.bind(checkBox);
      if(status)checkBox.checked = true;
      return checkBox;
    }

    const todoTextAdd = ({todo,status}) => {
      var aSpan = document.createElement('span');
      aSpan.className = (`tdo${(status?' stout':'')}`);
      aSpan.textContent = todo
      return aSpan;
    }

    const inputDiv = () => {
      let inDiv = document.createElement('div');
      inDiv.className = `addtodo`;

      let inBox = document.createElement('input');
      inBox.setAttribute('id',`todoinput`);
      inBox.setAttribute('placeholder',`Enter todo`);
      inBox.style.padding = `8px 5px`;
      inDiv.appendChild(inBox);

      let infa = document.createElement('i');
      infa.className = "fa fa-plus";
      infa.textContent = "+"
      infa.onclick = addTodo.bind(inBox);
      inDiv.appendChild(infa);
      return inDiv;
    }


    let singleCard = (obj) => {
      let ndiv = document.createElement('div');
      ndiv.style.padding =  `10px`;
      ndiv.className = "todoelement";
      ndiv.style.verticalAlign =  `super`;

      ndiv.appendChild(checkBoxAdd(obj));
      ndiv.appendChild(todoTextAdd(obj));
      ndiv.appendChild(deleteButton(obj));
      ndiv.appendChild(document.createElement('br'));

      return ndiv
    }

    function updateUI(node,p){
      p++;
      let uihtml = "";
      let ui = document.createElement('div');
      ui.style.margin = `5px ${30}px`;
      ui.style.width = `220px`;
      ui.style.boxShadow = '1px 1px 3px black';

      ui.appendChild(inputDiv());

      for(let i of node){
        ui.append(singleCard(i));
      }

      return ui;
    }

    function addTodo(){
      todos.push({
          'todo' : this.value,
          'id' : (new Date()).getTime().toString().substr(0, 13),
          'status' : 0
        })
      emitter.emit('todochanged', {todos: todos});
      return
    }



    function loadJson(){
      return new Promise((resolve)=>{
        let lStore = localStorage.getItem("todo");
        if(lStore){
          todos = JSON.parse(lStore);
          resolve()
        }else{
          fetch("https://sonukedia55.github.io/others/todoresponse.txt").then(res=>{
            res.json().then(val=>{
              console.log(val);
              todos = val;
              saveTodo();
              resolve()
            })
          })
        }
      });
    }

    loadJson().then(()=>{
      emitter.emit('todochanged', {todos: todos});
    })

    emitter.subscribe('todochanged', (data) => {
      saveTodo();
      document.getElementById('todos').innerHTML = ""
      document.getElementById('todos').append(updateUI(data.todos,0));
    });
