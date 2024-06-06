var B="top",S="bottom",L="right",$="left",Pt="auto",ft=[B,S,L,$],Q="start",ot="end",ue="clippingParents",Kt="viewport",nt="popper",le="reference",Ft=ft.reduce(function(t,e){return t.concat([e+"-"+Q,e+"-"+ot])},[]),Qt=[].concat(ft,[Pt]).reduce(function(t,e){return t.concat([e,e+"-"+Q,e+"-"+ot])},[]),ve="beforeRead",de="read",he="afterRead",me="beforeMain",ge="main",ye="afterMain",be="beforeWrite",we="write",xe="afterWrite",Oe=[ve,de,he,me,ge,ye,be,we,xe];function V(t){return t?(t.nodeName||"").toLowerCase():null}function k(t){if(t==null)return window;if(t.toString()!=="[object Window]"){var e=t.ownerDocument;return e&&e.defaultView||window}return t}function J(t){var e=k(t).Element;return t instanceof e||t instanceof Element}function T(t){var e=k(t).HTMLElement;return t instanceof e||t instanceof HTMLElement}function Dt(t){if(typeof ShadowRoot>"u")return!1;var e=k(t).ShadowRoot;return t instanceof e||t instanceof ShadowRoot}function Ae(t){var e=t.state;Object.keys(e.elements).forEach(function(r){var n=e.styles[r]||{},a=e.attributes[r]||{},i=e.elements[r];!T(i)||!V(i)||(Object.assign(i.style,n),Object.keys(a).forEach(function(p){var s=a[p];s===!1?i.removeAttribute(p):i.setAttribute(p,s===!0?"":s)}))})}function Ee(t){var e=t.state,r={popper:{position:e.options.strategy,left:"0",top:"0",margin:"0"},arrow:{position:"absolute"},reference:{}};return Object.assign(e.elements.popper.style,r.popper),e.styles=r,e.elements.arrow&&Object.assign(e.elements.arrow.style,r.arrow),function(){Object.keys(e.elements).forEach(function(n){var a=e.elements[n],i=e.attributes[n]||{},p=Object.keys(e.styles.hasOwnProperty(n)?e.styles[n]:r[n]),s=p.reduce(function(o,c){return o[c]="",o},{});!T(a)||!V(a)||(Object.assign(a.style,s),Object.keys(i).forEach(function(o){a.removeAttribute(o)}))})}}const Pe={name:"applyStyles",enabled:!0,phase:"write",fn:Ae,effect:Ee,requires:["computeStyles"]};function H(t){return t.split("-")[0]}var G=Math.max,gt=Math.min,Z=Math.round;function At(){var t=navigator.userAgentData;return t!=null&&t.brands&&Array.isArray(t.brands)?t.brands.map(function(e){return e.brand+"/"+e.version}).join(" "):navigator.userAgent}function Zt(){return!/^((?!chrome|android).)*safari/i.test(At())}function _(t,e,r){e===void 0&&(e=!1),r===void 0&&(r=!1);var n=t.getBoundingClientRect(),a=1,i=1;e&&T(t)&&(a=t.offsetWidth>0&&Z(n.width)/t.offsetWidth||1,i=t.offsetHeight>0&&Z(n.height)/t.offsetHeight||1);var p=J(t)?k(t):window,s=p.visualViewport,o=!Zt()&&r,c=(n.left+(o&&s?s.offsetLeft:0))/a,f=(n.top+(o&&s?s.offsetTop:0))/i,h=n.width/a,y=n.height/i;return{width:h,height:y,top:f,right:c+h,bottom:f+y,left:c,x:c,y:f}}function jt(t){var e=_(t),r=t.offsetWidth,n=t.offsetHeight;return Math.abs(e.width-r)<=1&&(r=e.width),Math.abs(e.height-n)<=1&&(n=e.height),{x:t.offsetLeft,y:t.offsetTop,width:r,height:n}}function _t(t,e){var r=e.getRootNode&&e.getRootNode();if(t.contains(e))return!0;if(r&&Dt(r)){var n=e;do{if(n&&t.isSameNode(n))return!0;n=n.parentNode||n.host}while(n)}return!1}function N(t){return k(t).getComputedStyle(t)}function De(t){return["table","td","th"].indexOf(V(t))>=0}function q(t){return((J(t)?t.ownerDocument:t.document)||window.document).documentElement}function yt(t){return V(t)==="html"?t:t.assignedSlot||t.parentNode||(Dt(t)?t.host:null)||q(t)}function qt(t){return!T(t)||N(t).position==="fixed"?null:t.offsetParent}function je(t){var e=/firefox/i.test(At()),r=/Trident/i.test(At());if(r&&T(t)){var n=N(t);if(n.position==="fixed")return null}var a=yt(t);for(Dt(a)&&(a=a.host);T(a)&&["html","body"].indexOf(V(a))<0;){var i=N(a);if(i.transform!=="none"||i.perspective!=="none"||i.contain==="paint"||["transform","perspective"].indexOf(i.willChange)!==-1||e&&i.willChange==="filter"||e&&i.filter&&i.filter!=="none")return a;a=a.parentNode}return null}function pt(t){for(var e=k(t),r=qt(t);r&&De(r)&&N(r).position==="static";)r=qt(r);return r&&(V(r)==="html"||V(r)==="body"&&N(r).position==="static")?e:r||je(t)||e}function Rt(t){return["top","bottom"].indexOf(t)>=0?"x":"y"}function at(t,e,r){return G(t,gt(e,r))}function Re(t,e,r){var n=at(t,e,r);return n>r?r:n}function te(){return{top:0,right:0,bottom:0,left:0}}function ee(t){return Object.assign({},te(),t)}function re(t,e){return e.reduce(function(r,n){return r[n]=t,r},{})}var Be=function(e,r){return e=typeof e=="function"?e(Object.assign({},r.rects,{placement:r.placement})):e,ee(typeof e!="number"?e:re(e,ft))};function $e(t){var e,r=t.state,n=t.name,a=t.options,i=r.elements.arrow,p=r.modifiersData.popperOffsets,s=H(r.placement),o=Rt(s),c=[$,L].indexOf(s)>=0,f=c?"height":"width";if(!(!i||!p)){var h=Be(a.padding,r),y=jt(i),u=o==="y"?B:$,w=o==="y"?S:L,d=r.rects.reference[f]+r.rects.reference[o]-p[o]-r.rects.popper[f],v=p[o]-r.rects.reference[o],b=pt(i),O=b?o==="y"?b.clientHeight||0:b.clientWidth||0:0,A=d/2-v/2,l=h[u],m=O-y[f]-h[w],g=O/2-y[f]/2+A,x=at(l,g,m),D=o;r.modifiersData[n]=(e={},e[D]=x,e.centerOffset=x-g,e)}}function Ce(t){var e=t.state,r=t.options,n=r.element,a=n===void 0?"[data-popper-arrow]":n;a!=null&&(typeof a=="string"&&(a=e.elements.popper.querySelector(a),!a)||_t(e.elements.popper,a)&&(e.elements.arrow=a))}const ke={name:"arrow",enabled:!0,phase:"main",fn:$e,effect:Ce,requires:["popperOffsets"],requiresIfExists:["preventOverflow"]};function tt(t){return t.split("-")[1]}var Te={top:"auto",right:"auto",bottom:"auto",left:"auto"};function Se(t,e){var r=t.x,n=t.y,a=e.devicePixelRatio||1;return{x:Z(r*a)/a||0,y:Z(n*a)/a||0}}function Xt(t){var e,r=t.popper,n=t.popperRect,a=t.placement,i=t.variation,p=t.offsets,s=t.position,o=t.gpuAcceleration,c=t.adaptive,f=t.roundOffsets,h=t.isFixed,y=p.x,u=y===void 0?0:y,w=p.y,d=w===void 0?0:w,v=typeof f=="function"?f({x:u,y:d}):{x:u,y:d};u=v.x,d=v.y;var b=p.hasOwnProperty("x"),O=p.hasOwnProperty("y"),A=$,l=B,m=window;if(c){var g=pt(r),x="clientHeight",D="clientWidth";if(g===k(r)&&(g=q(r),N(g).position!=="static"&&s==="absolute"&&(x="scrollHeight",D="scrollWidth")),g=g,a===B||(a===$||a===L)&&i===ot){l=S;var P=h&&g===m&&m.visualViewport?m.visualViewport.height:g[x];d-=P-n.height,d*=o?1:-1}if(a===$||(a===B||a===S)&&i===ot){A=L;var E=h&&g===m&&m.visualViewport?m.visualViewport.width:g[D];u-=E-n.width,u*=o?1:-1}}var j=Object.assign({position:s},c&&Te),M=f===!0?Se({x:u,y:d},k(r)):{x:u,y:d};if(u=M.x,d=M.y,o){var R;return Object.assign({},j,(R={},R[l]=O?"0":"",R[A]=b?"0":"",R.transform=(m.devicePixelRatio||1)<=1?"translate("+u+"px, "+d+"px)":"translate3d("+u+"px, "+d+"px, 0)",R))}return Object.assign({},j,(e={},e[l]=O?d+"px":"",e[A]=b?u+"px":"",e.transform="",e))}function Le(t){var e=t.state,r=t.options,n=r.gpuAcceleration,a=n===void 0?!0:n,i=r.adaptive,p=i===void 0?!0:i,s=r.roundOffsets,o=s===void 0?!0:s,c={placement:H(e.placement),variation:tt(e.placement),popper:e.elements.popper,popperRect:e.rects.popper,gpuAcceleration:a,isFixed:e.options.strategy==="fixed"};e.modifiersData.popperOffsets!=null&&(e.styles.popper=Object.assign({},e.styles.popper,Xt(Object.assign({},c,{offsets:e.modifiersData.popperOffsets,position:e.options.strategy,adaptive:p,roundOffsets:o})))),e.modifiersData.arrow!=null&&(e.styles.arrow=Object.assign({},e.styles.arrow,Xt(Object.assign({},c,{offsets:e.modifiersData.arrow,position:"absolute",adaptive:!1,roundOffsets:o})))),e.attributes.popper=Object.assign({},e.attributes.popper,{"data-popper-placement":e.placement})}const Me={name:"computeStyles",enabled:!0,phase:"beforeWrite",fn:Le,data:{}};var ht={passive:!0};function We(t){var e=t.state,r=t.instance,n=t.options,a=n.scroll,i=a===void 0?!0:a,p=n.resize,s=p===void 0?!0:p,o=k(e.elements.popper),c=[].concat(e.scrollParents.reference,e.scrollParents.popper);return i&&c.forEach(function(f){f.addEventListener("scroll",r.update,ht)}),s&&o.addEventListener("resize",r.update,ht),function(){i&&c.forEach(function(f){f.removeEventListener("scroll",r.update,ht)}),s&&o.removeEventListener("resize",r.update,ht)}}const He={name:"eventListeners",enabled:!0,phase:"write",fn:function(){},effect:We,data:{}};var Ve={left:"right",right:"left",bottom:"top",top:"bottom"};function mt(t){return t.replace(/left|right|bottom|top/g,function(e){return Ve[e]})}var Ne={start:"end",end:"start"};function It(t){return t.replace(/start|end/g,function(e){return Ne[e]})}function Bt(t){var e=k(t),r=e.pageXOffset,n=e.pageYOffset;return{scrollLeft:r,scrollTop:n}}function $t(t){return _(q(t)).left+Bt(t).scrollLeft}function Fe(t,e){var r=k(t),n=q(t),a=r.visualViewport,i=n.clientWidth,p=n.clientHeight,s=0,o=0;if(a){i=a.width,p=a.height;var c=Zt();(c||!c&&e==="fixed")&&(s=a.offsetLeft,o=a.offsetTop)}return{width:i,height:p,x:s+$t(t),y:o}}function qe(t){var e,r=q(t),n=Bt(t),a=(e=t.ownerDocument)==null?void 0:e.body,i=G(r.scrollWidth,r.clientWidth,a?a.scrollWidth:0,a?a.clientWidth:0),p=G(r.scrollHeight,r.clientHeight,a?a.scrollHeight:0,a?a.clientHeight:0),s=-n.scrollLeft+$t(t),o=-n.scrollTop;return N(a||r).direction==="rtl"&&(s+=G(r.clientWidth,a?a.clientWidth:0)-i),{width:i,height:p,x:s,y:o}}function Ct(t){var e=N(t),r=e.overflow,n=e.overflowX,a=e.overflowY;return/auto|scroll|overlay|hidden/.test(r+a+n)}function ne(t){return["html","body","#document"].indexOf(V(t))>=0?t.ownerDocument.body:T(t)&&Ct(t)?t:ne(yt(t))}function it(t,e){var r;e===void 0&&(e=[]);var n=ne(t),a=n===((r=t.ownerDocument)==null?void 0:r.body),i=k(n),p=a?[i].concat(i.visualViewport||[],Ct(n)?n:[]):n,s=e.concat(p);return a?s:s.concat(it(yt(p)))}function Et(t){return Object.assign({},t,{left:t.x,top:t.y,right:t.x+t.width,bottom:t.y+t.height})}function Xe(t,e){var r=_(t,!1,e==="fixed");return r.top=r.top+t.clientTop,r.left=r.left+t.clientLeft,r.bottom=r.top+t.clientHeight,r.right=r.left+t.clientWidth,r.width=t.clientWidth,r.height=t.clientHeight,r.x=r.left,r.y=r.top,r}function Yt(t,e,r){return e===Kt?Et(Fe(t,r)):J(e)?Xe(e,r):Et(qe(q(t)))}function Ie(t){var e=it(yt(t)),r=["absolute","fixed"].indexOf(N(t).position)>=0,n=r&&T(t)?pt(t):t;return J(n)?e.filter(function(a){return J(a)&&_t(a,n)&&V(a)!=="body"}):[]}function Ye(t,e,r,n){var a=e==="clippingParents"?Ie(t):[].concat(e),i=[].concat(a,[r]),p=i[0],s=i.reduce(function(o,c){var f=Yt(t,c,n);return o.top=G(f.top,o.top),o.right=gt(f.right,o.right),o.bottom=gt(f.bottom,o.bottom),o.left=G(f.left,o.left),o},Yt(t,p,n));return s.width=s.right-s.left,s.height=s.bottom-s.top,s.x=s.left,s.y=s.top,s}function ae(t){var e=t.reference,r=t.element,n=t.placement,a=n?H(n):null,i=n?tt(n):null,p=e.x+e.width/2-r.width/2,s=e.y+e.height/2-r.height/2,o;switch(a){case B:o={x:p,y:e.y-r.height};break;case S:o={x:p,y:e.y+e.height};break;case L:o={x:e.x+e.width,y:s};break;case $:o={x:e.x-r.width,y:s};break;default:o={x:e.x,y:e.y}}var c=a?Rt(a):null;if(c!=null){var f=c==="y"?"height":"width";switch(i){case Q:o[c]=o[c]-(e[f]/2-r[f]/2);break;case ot:o[c]=o[c]+(e[f]/2-r[f]/2);break}}return o}function st(t,e){e===void 0&&(e={});var r=e,n=r.placement,a=n===void 0?t.placement:n,i=r.strategy,p=i===void 0?t.strategy:i,s=r.boundary,o=s===void 0?ue:s,c=r.rootBoundary,f=c===void 0?Kt:c,h=r.elementContext,y=h===void 0?nt:h,u=r.altBoundary,w=u===void 0?!1:u,d=r.padding,v=d===void 0?0:d,b=ee(typeof v!="number"?v:re(v,ft)),O=y===nt?le:nt,A=t.rects.popper,l=t.elements[w?O:y],m=Ye(J(l)?l:l.contextElement||q(t.elements.popper),o,f,p),g=_(t.elements.reference),x=ae({reference:g,element:A,strategy:"absolute",placement:a}),D=Et(Object.assign({},A,x)),P=y===nt?D:g,E={top:m.top-P.top+b.top,bottom:P.bottom-m.bottom+b.bottom,left:m.left-P.left+b.left,right:P.right-m.right+b.right},j=t.modifiersData.offset;if(y===nt&&j){var M=j[a];Object.keys(E).forEach(function(R){var X=[L,S].indexOf(R)>=0?1:-1,I=[B,S].indexOf(R)>=0?"y":"x";E[R]+=M[I]*X})}return E}function ze(t,e){e===void 0&&(e={});var r=e,n=r.placement,a=r.boundary,i=r.rootBoundary,p=r.padding,s=r.flipVariations,o=r.allowedAutoPlacements,c=o===void 0?Qt:o,f=tt(n),h=f?s?Ft:Ft.filter(function(w){return tt(w)===f}):ft,y=h.filter(function(w){return c.indexOf(w)>=0});y.length===0&&(y=h);var u=y.reduce(function(w,d){return w[d]=st(t,{placement:d,boundary:a,rootBoundary:i,padding:p})[H(d)],w},{});return Object.keys(u).sort(function(w,d){return u[w]-u[d]})}function Ue(t){if(H(t)===Pt)return[];var e=mt(t);return[It(t),e,It(e)]}function Ge(t){var e=t.state,r=t.options,n=t.name;if(!e.modifiersData[n]._skip){for(var a=r.mainAxis,i=a===void 0?!0:a,p=r.altAxis,s=p===void 0?!0:p,o=r.fallbackPlacements,c=r.padding,f=r.boundary,h=r.rootBoundary,y=r.altBoundary,u=r.flipVariations,w=u===void 0?!0:u,d=r.allowedAutoPlacements,v=e.options.placement,b=H(v),O=b===v,A=o||(O||!w?[mt(v)]:Ue(v)),l=[v].concat(A).reduce(function(K,F){return K.concat(H(F)===Pt?ze(e,{placement:F,boundary:f,rootBoundary:h,padding:c,flipVariations:w,allowedAutoPlacements:d}):F)},[]),m=e.rects.reference,g=e.rects.popper,x=new Map,D=!0,P=l[0],E=0;E<l.length;E++){var j=l[E],M=H(j),R=tt(j)===Q,X=[B,S].indexOf(M)>=0,I=X?"width":"height",C=st(e,{placement:j,boundary:f,rootBoundary:h,altBoundary:y,padding:c}),W=X?R?L:$:R?S:B;m[I]>g[I]&&(W=mt(W));var ct=mt(W),Y=[];if(i&&Y.push(C[M]<=0),s&&Y.push(C[W]<=0,C[ct]<=0),Y.every(function(K){return K})){P=j,D=!1;break}x.set(j,Y)}if(D)for(var ut=w?3:1,bt=function(F){var rt=l.find(function(vt){var z=x.get(vt);if(z)return z.slice(0,F).every(function(wt){return wt})});if(rt)return P=rt,"break"},et=ut;et>0;et--){var lt=bt(et);if(lt==="break")break}e.placement!==P&&(e.modifiersData[n]._skip=!0,e.placement=P,e.reset=!0)}}const Je={name:"flip",enabled:!0,phase:"main",fn:Ge,requiresIfExists:["offset"],data:{_skip:!1}};function zt(t,e,r){return r===void 0&&(r={x:0,y:0}),{top:t.top-e.height-r.y,right:t.right-e.width+r.x,bottom:t.bottom-e.height+r.y,left:t.left-e.width-r.x}}function Ut(t){return[B,L,S,$].some(function(e){return t[e]>=0})}function Ke(t){var e=t.state,r=t.name,n=e.rects.reference,a=e.rects.popper,i=e.modifiersData.preventOverflow,p=st(e,{elementContext:"reference"}),s=st(e,{altBoundary:!0}),o=zt(p,n),c=zt(s,a,i),f=Ut(o),h=Ut(c);e.modifiersData[r]={referenceClippingOffsets:o,popperEscapeOffsets:c,isReferenceHidden:f,hasPopperEscaped:h},e.attributes.popper=Object.assign({},e.attributes.popper,{"data-popper-reference-hidden":f,"data-popper-escaped":h})}const Qe={name:"hide",enabled:!0,phase:"main",requiresIfExists:["preventOverflow"],fn:Ke};function Ze(t,e,r){var n=H(t),a=[$,B].indexOf(n)>=0?-1:1,i=typeof r=="function"?r(Object.assign({},e,{placement:t})):r,p=i[0],s=i[1];return p=p||0,s=(s||0)*a,[$,L].indexOf(n)>=0?{x:s,y:p}:{x:p,y:s}}function _e(t){var e=t.state,r=t.options,n=t.name,a=r.offset,i=a===void 0?[0,0]:a,p=Qt.reduce(function(f,h){return f[h]=Ze(h,e.rects,i),f},{}),s=p[e.placement],o=s.x,c=s.y;e.modifiersData.popperOffsets!=null&&(e.modifiersData.popperOffsets.x+=o,e.modifiersData.popperOffsets.y+=c),e.modifiersData[n]=p}const tr={name:"offset",enabled:!0,phase:"main",requires:["popperOffsets"],fn:_e};function er(t){var e=t.state,r=t.name;e.modifiersData[r]=ae({reference:e.rects.reference,element:e.rects.popper,strategy:"absolute",placement:e.placement})}const rr={name:"popperOffsets",enabled:!0,phase:"read",fn:er,data:{}};function nr(t){return t==="x"?"y":"x"}function ar(t){var e=t.state,r=t.options,n=t.name,a=r.mainAxis,i=a===void 0?!0:a,p=r.altAxis,s=p===void 0?!1:p,o=r.boundary,c=r.rootBoundary,f=r.altBoundary,h=r.padding,y=r.tether,u=y===void 0?!0:y,w=r.tetherOffset,d=w===void 0?0:w,v=st(e,{boundary:o,rootBoundary:c,padding:h,altBoundary:f}),b=H(e.placement),O=tt(e.placement),A=!O,l=Rt(b),m=nr(l),g=e.modifiersData.popperOffsets,x=e.rects.reference,D=e.rects.popper,P=typeof d=="function"?d(Object.assign({},e.rects,{placement:e.placement})):d,E=typeof P=="number"?{mainAxis:P,altAxis:P}:Object.assign({mainAxis:0,altAxis:0},P),j=e.modifiersData.offset?e.modifiersData.offset[e.placement]:null,M={x:0,y:0};if(g){if(i){var R,X=l==="y"?B:$,I=l==="y"?S:L,C=l==="y"?"height":"width",W=g[l],ct=W+v[X],Y=W-v[I],ut=u?-D[C]/2:0,bt=O===Q?x[C]:D[C],et=O===Q?-D[C]:-x[C],lt=e.elements.arrow,K=u&&lt?jt(lt):{width:0,height:0},F=e.modifiersData["arrow#persistent"]?e.modifiersData["arrow#persistent"].padding:te(),rt=F[X],vt=F[I],z=at(0,x[C],K[C]),wt=A?x[C]/2-ut-z-rt-E.mainAxis:bt-z-rt-E.mainAxis,ie=A?-x[C]/2+ut+z+vt+E.mainAxis:et+z+vt+E.mainAxis,xt=e.elements.arrow&&pt(e.elements.arrow),oe=xt?l==="y"?xt.clientTop||0:xt.clientLeft||0:0,kt=(R=j==null?void 0:j[l])!=null?R:0,se=W+wt-kt-oe,fe=W+ie-kt,Tt=at(u?gt(ct,se):ct,W,u?G(Y,fe):Y);g[l]=Tt,M[l]=Tt-W}if(s){var St,pe=l==="x"?B:$,ce=l==="x"?S:L,U=g[m],dt=m==="y"?"height":"width",Lt=U+v[pe],Mt=U-v[ce],Ot=[B,$].indexOf(b)!==-1,Wt=(St=j==null?void 0:j[m])!=null?St:0,Ht=Ot?Lt:U-x[dt]-D[dt]-Wt+E.altAxis,Vt=Ot?U+x[dt]+D[dt]-Wt-E.altAxis:Mt,Nt=u&&Ot?Re(Ht,U,Vt):at(u?Ht:Lt,U,u?Vt:Mt);g[m]=Nt,M[m]=Nt-U}e.modifiersData[n]=M}}const ir={name:"preventOverflow",enabled:!0,phase:"main",fn:ar,requiresIfExists:["offset"]};function or(t){return{scrollLeft:t.scrollLeft,scrollTop:t.scrollTop}}function sr(t){return t===k(t)||!T(t)?Bt(t):or(t)}function fr(t){var e=t.getBoundingClientRect(),r=Z(e.width)/t.offsetWidth||1,n=Z(e.height)/t.offsetHeight||1;return r!==1||n!==1}function pr(t,e,r){r===void 0&&(r=!1);var n=T(e),a=T(e)&&fr(e),i=q(e),p=_(t,a,r),s={scrollLeft:0,scrollTop:0},o={x:0,y:0};return(n||!n&&!r)&&((V(e)!=="body"||Ct(i))&&(s=sr(e)),T(e)?(o=_(e,!0),o.x+=e.clientLeft,o.y+=e.clientTop):i&&(o.x=$t(i))),{x:p.left+s.scrollLeft-o.x,y:p.top+s.scrollTop-o.y,width:p.width,height:p.height}}function cr(t){var e=new Map,r=new Set,n=[];t.forEach(function(i){e.set(i.name,i)});function a(i){r.add(i.name);var p=[].concat(i.requires||[],i.requiresIfExists||[]);p.forEach(function(s){if(!r.has(s)){var o=e.get(s);o&&a(o)}}),n.push(i)}return t.forEach(function(i){r.has(i.name)||a(i)}),n}function ur(t){var e=cr(t);return Oe.reduce(function(r,n){return r.concat(e.filter(function(a){return a.phase===n}))},[])}function lr(t){var e;return function(){return e||(e=new Promise(function(r){Promise.resolve().then(function(){e=void 0,r(t())})})),e}}function vr(t){var e=t.reduce(function(r,n){var a=r[n.name];return r[n.name]=a?Object.assign({},a,n,{options:Object.assign({},a.options,n.options),data:Object.assign({},a.data,n.data)}):n,r},{});return Object.keys(e).map(function(r){return e[r]})}var Gt={placement:"bottom",modifiers:[],strategy:"absolute"};function Jt(){for(var t=arguments.length,e=new Array(t),r=0;r<t;r++)e[r]=arguments[r];return!e.some(function(n){return!(n&&typeof n.getBoundingClientRect=="function")})}function dr(t){t===void 0&&(t={});var e=t,r=e.defaultModifiers,n=r===void 0?[]:r,a=e.defaultOptions,i=a===void 0?Gt:a;return function(s,o,c){c===void 0&&(c=i);var f={placement:"bottom",orderedModifiers:[],options:Object.assign({},Gt,i),modifiersData:{},elements:{reference:s,popper:o},attributes:{},styles:{}},h=[],y=!1,u={state:f,setOptions:function(b){var O=typeof b=="function"?b(f.options):b;d(),f.options=Object.assign({},i,f.options,O),f.scrollParents={reference:J(s)?it(s):s.contextElement?it(s.contextElement):[],popper:it(o)};var A=ur(vr([].concat(n,f.options.modifiers)));return f.orderedModifiers=A.filter(function(l){return l.enabled}),w(),u.update()},forceUpdate:function(){if(!y){var b=f.elements,O=b.reference,A=b.popper;if(Jt(O,A)){f.rects={reference:pr(O,pt(A),f.options.strategy==="fixed"),popper:jt(A)},f.reset=!1,f.placement=f.options.placement,f.orderedModifiers.forEach(function(E){return f.modifiersData[E.name]=Object.assign({},E.data)});for(var l=0;l<f.orderedModifiers.length;l++){if(f.reset===!0){f.reset=!1,l=-1;continue}var m=f.orderedModifiers[l],g=m.fn,x=m.options,D=x===void 0?{}:x,P=m.name;typeof g=="function"&&(f=g({state:f,options:D,name:P,instance:u})||f)}}}},update:lr(function(){return new Promise(function(v){u.forceUpdate(),v(f)})}),destroy:function(){d(),y=!0}};if(!Jt(s,o))return u;u.setOptions(c).then(function(v){!y&&c.onFirstUpdate&&c.onFirstUpdate(v)});function w(){f.orderedModifiers.forEach(function(v){var b=v.name,O=v.options,A=O===void 0?{}:O,l=v.effect;if(typeof l=="function"){var m=l({state:f,name:b,instance:u,options:A}),g=function(){};h.push(m||g)}})}function d(){h.forEach(function(v){return v()}),h=[]}return u}}var hr=[He,rr,Me,Pe,tr,Je,ir,ke,Qe],mr=dr({defaultModifiers:hr});export{Pe as a,mr as c};
