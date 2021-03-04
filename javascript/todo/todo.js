
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
      emitter.emit('todochanged', {todos: todos});
    }

    function switchCheck(evt){
      const e =  evt.target
      let pId = e.getAttribute('data-id');
      changeStatus(pId,e.checked);
    }


    const deleteButton = ({id}) => {
      let aDelete = createElement('a',[],{'id':`d${id}`,'data-id':id,'data-action':'delete'});
      aDelete.onclick = deleteTodo.bind(aDelete);
      aDelete.innerHTML = `<i class="fa fa-close">X</i>`;
      return aDelete;
    }

    const checkBoxAdd = ({id,status}) => {
      let checkBox = createElement('input',[],{'id':`d${id}`,'data-id':id,'type':`checkbox`});
      checkBox.onchange = switchCheck.bind(checkBox);
      if(status)checkBox.checked = true;
      return checkBox;
    }

    const todoTextAdd = ({todo,status}) => {
      let aSpan = createElement('span',['tdo',...(status?['stout']:[])],{'id':`todoinput`,'placeholder':`Enter todo`});
      aSpan.textContent = todo
      return aSpan;
    }

    const inputDiv = () => {
      let inDiv = createElement('div',[`addtodo`],{});
      let inBox = createElement('input',['inputbox'],{'id':`todoinput`,'placeholder':`Enter todo`});
      let infa = createElement('i',['fa','fa-plus'],{});
      infa.textContent = "+"
      infa.onclick = addTodo.bind(inBox);
      inDiv.appendChild(inBox);
      inDiv.appendChild(infa);
      return inDiv;
    }


    let singleCard = (obj) => {
      let ndiv = createElement('div',['todoelement'],{'id':`todoinput`,'placeholder':`Enter todo`});
      ndiv.appendChild(checkBoxAdd(obj));
      ndiv.appendChild(todoTextAdd(obj));
      ndiv.appendChild(deleteButton(obj));
      ndiv.appendChild(document.createElement('br'));
      return ndiv
    }

    function updateUI(node){
      let ui = createElement('div',['uimain'],{});
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
      document.getElementById('todos').append(updateUI(data.todos));
    });
