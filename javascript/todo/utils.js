

    function createElement(type,classList,attr){
      let newEle = document.createElement(type);
      if(classList.length)newEle.className = classList.join(" ")
      for(var k in attr){
        if(typeof attr[k] != 'function'){
          newEle.setAttribute(k,attr[k]);
        }
      }
      return newEle;
    }


    function saveTodo(){
      localStorage.setItem("todo",JSON.stringify(todos));
    }


    class EventEmitter {
        constructor() {
          this.events = {};
        }
        emit(eventName, data) {
          const event = this.events[eventName];
          if( event ) {
            event.forEach(fn => {
              fn.call(null, data);
            });
          }
        }
        subscribe(eventName, fn) {
          if(!this.events[eventName]) {
            this.events[eventName] = [];
          }
          this.events[eventName].push(fn);
          return () => {
            this.events[eventName] = this.events[eventName].filter(eventFn => fn !== eventFn);
          }
        }
    }

    let emitter = new EventEmitter();
