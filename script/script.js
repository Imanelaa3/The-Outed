"use strict";

const chat = document.querySelector('.blockChat .chat');
const messageInp=document.querySelector('#message');
const sendBtn=document.querySelector('#sendMessage');
let conn;



sendBtn.addEventListener("click", handleMessage);
messageInp.addEventListener("keypress", e=>e.key==="Enter"?handleMessage.bind(sendBtn)():"");

login();

function login(){
    if( !conn){
        conn=new WebSocket("ws://localhost:8000");
        messageInp.focus();
        setting();
    }
    else if (conn)
    {
        sendMessage("Server", `${user} est déconnecté(e)!`);
        conn.close();
        conn= undefined;

    }
}
function setting (){
    conn.onopen=()=>{
        onMessage({sender:"Server", message:"Connexion établie"});
        sendMessage("Server",`${user} est connecté(e) !`);
    };
    conn.onclose= ()=>onMessage({sender:"Server", message:"Déconnecté(e)!"});
    conn.onmessage=e=>onMessage(JSON.parse(e.data));
}



function onMessage(m){
    chat.textContent += `${m.sender} :${m.message}\r\n`;
    chat.scrollTop=chat.scrollHeight;
}

function handleMessage(){
    if(messageInp.value)
    {
        onMessage({sender:user, message:messageInp.value});
        sendMessage(user, messageInp.value);
        messageInp.value="";
        messageInp.focus();

    }
}
function sendMessage(u, m){
    conn.send(JSON.stringify({sender:u, message:m}));
}