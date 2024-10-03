/*!
* Tabler v1.0.0-beta20 (https://tabler.io)
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
*/(function(e){typeof define=="function"&&define.amd?define(e):e()})(function(){var e,a="tablerTheme",t=new Proxy(new URLSearchParams(window.location.search),{get:function(o,r){return o.get(r)}});if(t.theme)localStorage.setItem(a,t.theme),e=t.theme;else{var n=localStorage.getItem(a);e=n||"light"}e==="dark"?document.body.setAttribute("data-bs-theme",e):document.body.removeAttribute("data-bs-theme")});
