

    function counterUpdate(todos){
      document.querySelector('#status').textContent = `${(todos.filter(i=>{return i.status})).length} / ${todos.length}`
      return
    }

    emitter.subscribe('todochanged', (data) => {
      counterUpdate(data.todos);
    });
