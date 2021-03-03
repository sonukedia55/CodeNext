
    function addNotification(text){
      let newNotify = document.createElement('div');
      newNotify.innerHTML = text;

      let container = document.getElementById('notify');
      container.insertBefore(newNotify, container.firstChild);
      let childs = container.childNodes
      if(childs.length>3){container.removeChild(container.lastChild);}
    }

    emitter.subscribe('todochanged', data => {
      if(data.message)addNotification(data.message);
    });
