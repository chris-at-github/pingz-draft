var q={init:function(){this.p=this.r(this.v)||"unknown-browser",this.o=this.s(navigator.userAgent)||this.s(navigator.appVersion)||"unknown-version",this.n=this.r(this.u)||"unknown-os",document.getElementsByTagName("html")[0].className="js "+this.n+" "+this.p+" "+this.p+"-"+this.o},r:function(n){for(var i=0;i<n.length;i++){var t=n[i].x,e=n[i].t;if(this.w=n[i].w||n[i].y,t){if(-1!=t.indexOf(n[i].z))return n[i].y.toLowerCase()}else if(e)return n[i].y.toLowerCase()}},s:function(n){var i=n.indexOf(this.w);if(-1!=i)return parseFloat(n.substring(i+this.w.length+1))},v:[{x:navigator.userAgent,z:"Chrome",y:"Chrome"},{x:navigator.userAgent,z:"OmniWeb",w:"OmniWeb/",y:"OmniWeb"},{x:navigator.vendor,z:"Apple",y:"Safari",w:"Version"},{t:window.opera,y:"Opera",w:"Version"},{x:navigator.vendor,z:"iCab",y:"iCab"},{x:navigator.vendor,z:"KDE",y:"Konqueror"},{x:navigator.userAgent,z:"Firefox",y:"Firefox"},{x:navigator.vendor,z:"Camino",y:"Camino"},{x:navigator.userAgent,z:"Netscape",y:"Netscape"},{x:navigator.userAgent,z:"MSIE",y:"IE",w:"MSIE"},{x:navigator.userAgent,z:"Gecko",y:"Mozilla",w:"rv"},{x:navigator.userAgent,z:"Mozilla",y:"Netscape",w:"Mozilla"}],u:[{x:navigator.platform,z:"Win",y:"Windows"},{x:navigator.platform,z:"Mac",y:"Mac"},{x:navigator.userAgent,z:"iPhone",y:"iPhone/iPod"},{x:navigator.platform,z:"Linux",y:"Linux"}]};q.init();