import{X as k,U as se,Y as re,Z as le,$ as ae,a0 as oe,a1 as he,a2 as S,a3 as F,a4 as _,a5 as P,a6 as j,a7 as m,a8 as B,a9 as V,aa as ce,ab as de,ac as ge,ad as ue,ae as pe,af as Z,ag as D,ah as A,ai as N,aj as fe,ak as Ee,al as J,am as ve,an as me,ao as Se,ap as De,aq as we,ar as ye,as as Te,at as x,au as O,av as be,aw as Me,ax as Y,ay as K,az as Q,aA as C,aB as Re,aC as $,aD as G,aE as Ce,aF as v,aG as Ie,aH as Pe,aI as je,aJ as Ae,aK as xe,aL as Le,aM as He}from"./index-a24f3392.js";A.touchMouseIgnoreWait=500;let X=0,I=0,U=!1;class ee{constructor(e){this.subjectEl=null,this.selector="",this.handleSelector="",this.shouldIgnoreMove=!1,this.shouldWatchScroll=!0,this.isDragging=!1,this.isTouchDragging=!1,this.wasTouchScroll=!1,this.handleMouseDown=t=>{if(!this.shouldIgnoreMouse()&&Ne(t)&&this.tryStart(t)){let i=this.createEventFromMouse(t,!0);this.emitter.trigger("pointerdown",i),this.initScrollWatch(i),this.shouldIgnoreMove||document.addEventListener("mousemove",this.handleMouseMove),document.addEventListener("mouseup",this.handleMouseUp)}},this.handleMouseMove=t=>{let i=this.createEventFromMouse(t);this.recordCoords(i),this.emitter.trigger("pointermove",i)},this.handleMouseUp=t=>{document.removeEventListener("mousemove",this.handleMouseMove),document.removeEventListener("mouseup",this.handleMouseUp),this.emitter.trigger("pointerup",this.createEventFromMouse(t)),this.cleanup()},this.handleTouchStart=t=>{if(this.tryStart(t)){this.isTouchDragging=!0;let i=this.createEventFromTouch(t,!0);this.emitter.trigger("pointerdown",i),this.initScrollWatch(i);let n=t.target;this.shouldIgnoreMove||n.addEventListener("touchmove",this.handleTouchMove),n.addEventListener("touchend",this.handleTouchEnd),n.addEventListener("touchcancel",this.handleTouchEnd),window.addEventListener("scroll",this.handleTouchScroll,!0)}},this.handleTouchMove=t=>{let i=this.createEventFromTouch(t);this.recordCoords(i),this.emitter.trigger("pointermove",i)},this.handleTouchEnd=t=>{if(this.isDragging){let i=t.target;i.removeEventListener("touchmove",this.handleTouchMove),i.removeEventListener("touchend",this.handleTouchEnd),i.removeEventListener("touchcancel",this.handleTouchEnd),window.removeEventListener("scroll",this.handleTouchScroll,!0),this.emitter.trigger("pointerup",this.createEventFromTouch(t)),this.cleanup(),this.isTouchDragging=!1,Ve()}},this.handleTouchScroll=()=>{this.wasTouchScroll=!0},this.handleScroll=t=>{if(!this.shouldIgnoreMove){let i=window.scrollX-this.prevScrollX+this.prevPageX,n=window.scrollY-this.prevScrollY+this.prevPageY;this.emitter.trigger("pointermove",{origEvent:t,isTouch:this.isTouchDragging,subjectEl:this.subjectEl,pageX:i,pageY:n,deltaX:i-this.origPageX,deltaY:n-this.origPageY})}},this.containerEl=e,this.emitter=new Z,e.addEventListener("mousedown",this.handleMouseDown),e.addEventListener("touchstart",this.handleTouchStart,{passive:!0}),Ye()}destroy(){this.containerEl.removeEventListener("mousedown",this.handleMouseDown),this.containerEl.removeEventListener("touchstart",this.handleTouchStart,{passive:!0}),Xe()}tryStart(e){let t=this.querySubjectEl(e),i=e.target;return t&&(!this.handleSelector||D(i,this.handleSelector))?(this.subjectEl=t,this.isDragging=!0,this.wasTouchScroll=!1,!0):!1}cleanup(){U=!1,this.isDragging=!1,this.subjectEl=null,this.destroyScrollWatch()}querySubjectEl(e){return this.selector?D(e.target,this.selector):this.containerEl}shouldIgnoreMouse(){return X||this.isTouchDragging}cancelTouchScroll(){this.isDragging&&(U=!0)}initScrollWatch(e){this.shouldWatchScroll&&(this.recordCoords(e),window.addEventListener("scroll",this.handleScroll,!0))}recordCoords(e){this.shouldWatchScroll&&(this.prevPageX=e.pageX,this.prevPageY=e.pageY,this.prevScrollX=window.scrollX,this.prevScrollY=window.scrollY)}destroyScrollWatch(){this.shouldWatchScroll&&window.removeEventListener("scroll",this.handleScroll,!0)}createEventFromMouse(e,t){let i=0,n=0;return t?(this.origPageX=e.pageX,this.origPageY=e.pageY):(i=e.pageX-this.origPageX,n=e.pageY-this.origPageY),{origEvent:e,isTouch:!1,subjectEl:this.subjectEl,pageX:e.pageX,pageY:e.pageY,deltaX:i,deltaY:n}}createEventFromTouch(e,t){let i=e.touches,n,l,s=0,r=0;return i&&i.length?(n=i[0].pageX,l=i[0].pageY):(n=e.pageX,l=e.pageY),t?(this.origPageX=n,this.origPageY=l):(s=n-this.origPageX,r=l-this.origPageY),{origEvent:e,isTouch:!0,subjectEl:this.subjectEl,pageX:n,pageY:l,deltaX:s,deltaY:r}}}function Ne(h){return h.button===0&&!h.ctrlKey}function Ve(){X+=1,setTimeout(()=>{X-=1},A.touchMouseIgnoreWait)}function Ye(){I+=1,I===1&&window.addEventListener("touchmove",te,{passive:!1})}function Xe(){I-=1,I||window.removeEventListener("touchmove",te,{passive:!1})}function te(h){U&&h.preventDefault()}class Ue{constructor(){this.isVisible=!1,this.sourceEl=null,this.mirrorEl=null,this.sourceElRect=null,this.parentNode=document.body,this.zIndex=9999,this.revertDuration=0}start(e,t,i){this.sourceEl=e,this.sourceElRect=this.sourceEl.getBoundingClientRect(),this.origScreenX=t-window.scrollX,this.origScreenY=i-window.scrollY,this.deltaX=0,this.deltaY=0,this.updateElPosition()}handleMove(e,t){this.deltaX=e-window.scrollX-this.origScreenX,this.deltaY=t-window.scrollY-this.origScreenY,this.updateElPosition()}setIsVisible(e){e?this.isVisible||(this.mirrorEl&&(this.mirrorEl.style.display=""),this.isVisible=e,this.updateElPosition()):this.isVisible&&(this.mirrorEl&&(this.mirrorEl.style.display="none"),this.isVisible=e)}stop(e,t){let i=()=>{this.cleanup(),t()};e&&this.mirrorEl&&this.isVisible&&this.revertDuration&&(this.deltaX||this.deltaY)?this.doRevertAnimation(i,this.revertDuration):setTimeout(i,0)}doRevertAnimation(e,t){let i=this.mirrorEl,n=this.sourceEl.getBoundingClientRect();i.style.transition="top "+t+"ms,left "+t+"ms",N(i,{left:n.left,top:n.top}),fe(i,()=>{i.style.transition="",e()})}cleanup(){this.mirrorEl&&(Ee(this.mirrorEl),this.mirrorEl=null),this.sourceEl=null}updateElPosition(){this.sourceEl&&this.isVisible&&N(this.getMirrorEl(),{left:this.sourceElRect.left+this.deltaX,top:this.sourceElRect.top+this.deltaY})}getMirrorEl(){let e=this.sourceElRect,t=this.mirrorEl;return t||(t=this.mirrorEl=this.sourceEl.cloneNode(!0),t.style.userSelect="none",t.style.webkitUserSelect="none",t.style.pointerEvents="none",t.classList.add("fc-event-dragging"),N(t,{position:"fixed",zIndex:this.zIndex,visibility:"",boxSizing:"border-box",width:e.right-e.left,height:e.bottom-e.top,right:"auto",bottom:"auto",margin:0}),this.parentNode.appendChild(t)),t}}class ie extends xe{constructor(e,t){super(),this.handleScroll=()=>{this.scrollTop=this.scrollController.getScrollTop(),this.scrollLeft=this.scrollController.getScrollLeft(),this.handleScrollChange()},this.scrollController=e,this.doesListening=t,this.scrollTop=this.origScrollTop=e.getScrollTop(),this.scrollLeft=this.origScrollLeft=e.getScrollLeft(),this.scrollWidth=e.getScrollWidth(),this.scrollHeight=e.getScrollHeight(),this.clientWidth=e.getClientWidth(),this.clientHeight=e.getClientHeight(),this.clientRect=this.computeClientRect(),this.doesListening&&this.getEventTarget().addEventListener("scroll",this.handleScroll)}destroy(){this.doesListening&&this.getEventTarget().removeEventListener("scroll",this.handleScroll)}getScrollTop(){return this.scrollTop}getScrollLeft(){return this.scrollLeft}setScrollTop(e){this.scrollController.setScrollTop(e),this.doesListening||(this.scrollTop=Math.max(Math.min(e,this.getMaxScrollTop()),0),this.handleScrollChange())}setScrollLeft(e){this.scrollController.setScrollLeft(e),this.doesListening||(this.scrollLeft=Math.max(Math.min(e,this.getMaxScrollLeft()),0),this.handleScrollChange())}getClientWidth(){return this.clientWidth}getClientHeight(){return this.clientHeight}getScrollWidth(){return this.scrollWidth}getScrollHeight(){return this.scrollHeight}handleScrollChange(){}}class ne extends ie{constructor(e,t){super(new Ie(e),t)}getEventTarget(){return this.scrollController.el}computeClientRect(){return Pe(this.scrollController.el)}}class _e extends ie{constructor(e){super(new je,e)}getEventTarget(){return window}computeClientRect(){return{left:this.scrollLeft,right:this.scrollLeft+this.clientWidth,top:this.scrollTop,bottom:this.scrollTop+this.clientHeight}}handleScrollChange(){this.clientRect=this.computeClientRect()}}const z=typeof performance=="function"?performance.now:Date.now;class Oe{constructor(){this.isEnabled=!0,this.scrollQuery=[window,".fc-scroller"],this.edgeThreshold=50,this.maxVelocity=300,this.pointerScreenX=null,this.pointerScreenY=null,this.isAnimating=!1,this.scrollCaches=null,this.everMovedUp=!1,this.everMovedDown=!1,this.everMovedLeft=!1,this.everMovedRight=!1,this.animate=()=>{if(this.isAnimating){let e=this.computeBestEdge(this.pointerScreenX+window.scrollX,this.pointerScreenY+window.scrollY);if(e){let t=z();this.handleSide(e,(t-this.msSinceRequest)/1e3),this.requestAnimation(t)}else this.isAnimating=!1}}}start(e,t,i){this.isEnabled&&(this.scrollCaches=this.buildCaches(i),this.pointerScreenX=null,this.pointerScreenY=null,this.everMovedUp=!1,this.everMovedDown=!1,this.everMovedLeft=!1,this.everMovedRight=!1,this.handleMove(e,t))}handleMove(e,t){if(this.isEnabled){let i=e-window.scrollX,n=t-window.scrollY,l=this.pointerScreenY===null?0:n-this.pointerScreenY,s=this.pointerScreenX===null?0:i-this.pointerScreenX;l<0?this.everMovedUp=!0:l>0&&(this.everMovedDown=!0),s<0?this.everMovedLeft=!0:s>0&&(this.everMovedRight=!0),this.pointerScreenX=i,this.pointerScreenY=n,this.isAnimating||(this.isAnimating=!0,this.requestAnimation(z()))}}stop(){if(this.isEnabled){this.isAnimating=!1;for(let e of this.scrollCaches)e.destroy();this.scrollCaches=null}}requestAnimation(e){this.msSinceRequest=e,requestAnimationFrame(this.animate)}handleSide(e,t){let{scrollCache:i}=e,{edgeThreshold:n}=this,l=n-e.distance,s=l*l/(n*n)*this.maxVelocity*t,r=1;switch(e.name){case"left":r=-1;case"right":i.setScrollLeft(i.getScrollLeft()+s*r);break;case"top":r=-1;case"bottom":i.setScrollTop(i.getScrollTop()+s*r);break}}computeBestEdge(e,t){let{edgeThreshold:i}=this,n=null,l=this.scrollCaches||[];for(let s of l){let r=s.clientRect,a=e-r.left,o=r.right-e,d=t-r.top,c=r.bottom-t;a>=0&&o>=0&&d>=0&&c>=0&&(d<=i&&this.everMovedUp&&s.canScrollUp()&&(!n||n.distance>d)&&(n={scrollCache:s,name:"top",distance:d}),c<=i&&this.everMovedDown&&s.canScrollDown()&&(!n||n.distance>c)&&(n={scrollCache:s,name:"bottom",distance:c}),a<=i&&this.everMovedLeft&&s.canScrollLeft()&&(!n||n.distance>a)&&(n={scrollCache:s,name:"left",distance:a}),o<=i&&this.everMovedRight&&s.canScrollRight()&&(!n||n.distance>o)&&(n={scrollCache:s,name:"right",distance:o}))}return n}buildCaches(e){return this.queryScrollEls(e).map(t=>t===window?new _e(!1):new ne(t,!1))}queryScrollEls(e){let t=[];for(let i of this.scrollQuery)typeof i=="object"?t.push(i):t.push(...Array.prototype.slice.call(e.getRootNode().querySelectorAll(i)));return t}}class w extends re{constructor(e,t){super(e),this.containerEl=e,this.delay=null,this.minDistance=0,this.touchScrollAllowed=!0,this.mirrorNeedsRevert=!1,this.isInteracting=!1,this.isDragging=!1,this.isDelayEnded=!1,this.isDistanceSurpassed=!1,this.delayTimeoutId=null,this.onPointerDown=n=>{this.isDragging||(this.isInteracting=!0,this.isDelayEnded=!1,this.isDistanceSurpassed=!1,le(document.body),ae(document.body),n.isTouch||n.origEvent.preventDefault(),this.emitter.trigger("pointerdown",n),this.isInteracting&&!this.pointer.shouldIgnoreMove&&(this.mirror.setIsVisible(!1),this.mirror.start(n.subjectEl,n.pageX,n.pageY),this.startDelay(n),this.minDistance||this.handleDistanceSurpassed(n)))},this.onPointerMove=n=>{if(this.isInteracting){if(this.emitter.trigger("pointermove",n),!this.isDistanceSurpassed){let l=this.minDistance,s,{deltaX:r,deltaY:a}=n;s=r*r+a*a,s>=l*l&&this.handleDistanceSurpassed(n)}this.isDragging&&(n.origEvent.type!=="scroll"&&(this.mirror.handleMove(n.pageX,n.pageY),this.autoScroller.handleMove(n.pageX,n.pageY)),this.emitter.trigger("dragmove",n))}},this.onPointerUp=n=>{this.isInteracting&&(this.isInteracting=!1,oe(document.body),he(document.body),this.emitter.trigger("pointerup",n),this.isDragging&&(this.autoScroller.stop(),this.tryStopDrag(n)),this.delayTimeoutId&&(clearTimeout(this.delayTimeoutId),this.delayTimeoutId=null))};let i=this.pointer=new ee(e);i.emitter.on("pointerdown",this.onPointerDown),i.emitter.on("pointermove",this.onPointerMove),i.emitter.on("pointerup",this.onPointerUp),t&&(i.selector=t),this.mirror=new Ue,this.autoScroller=new Oe}destroy(){this.pointer.destroy(),this.onPointerUp({})}startDelay(e){typeof this.delay=="number"?this.delayTimeoutId=setTimeout(()=>{this.delayTimeoutId=null,this.handleDelayEnd(e)},this.delay):this.handleDelayEnd(e)}handleDelayEnd(e){this.isDelayEnded=!0,this.tryStartDrag(e)}handleDistanceSurpassed(e){this.isDistanceSurpassed=!0,this.tryStartDrag(e)}tryStartDrag(e){this.isDelayEnded&&this.isDistanceSurpassed&&(!this.pointer.wasTouchScroll||this.touchScrollAllowed)&&(this.isDragging=!0,this.mirrorNeedsRevert=!1,this.autoScroller.start(e.pageX,e.pageY,this.containerEl),this.emitter.trigger("dragstart",e),this.touchScrollAllowed===!1&&this.pointer.cancelTouchScroll())}tryStopDrag(e){this.mirror.stop(this.mirrorNeedsRevert,this.stopDrag.bind(this,e))}stopDrag(e){this.isDragging=!1,this.emitter.trigger("dragend",e)}setIgnoreMove(e){this.pointer.shouldIgnoreMove=e}setMirrorIsVisible(e){this.mirror.setIsVisible(e)}setMirrorNeedsRevert(e){this.mirrorNeedsRevert=e}setAutoScrollEnabled(e){this.autoScroller.isEnabled=e}}class qe{constructor(e){this.el=e,this.origRect=J(e),this.scrollCaches=Le(e).map(t=>new ne(t,!0))}destroy(){for(let e of this.scrollCaches)e.destroy()}computeLeft(){let e=this.origRect.left;for(let t of this.scrollCaches)e+=t.origScrollLeft-t.getScrollLeft();return e}computeTop(){let e=this.origRect.top;for(let t of this.scrollCaches)e+=t.origScrollTop-t.getScrollTop();return e}isWithinClipping(e,t){let i={left:e,top:t};for(let n of this.scrollCaches)if(!We(n.getEventTarget())&&!He(i,n.clientRect))return!1;return!0}}function We(h){let e=h.tagName;return e==="HTML"||e==="BODY"}class T{constructor(e,t){this.useSubjectCenter=!1,this.requireInitial=!0,this.disablePointCheck=!1,this.initialHit=null,this.movingHit=null,this.finalHit=null,this.handlePointerDown=i=>{let{dragging:n}=this;this.initialHit=null,this.movingHit=null,this.finalHit=null,this.prepareHits(),this.processFirstCoord(i),this.initialHit||!this.requireInitial?(n.setIgnoreMove(!1),this.emitter.trigger("pointerdown",i)):n.setIgnoreMove(!0)},this.handleDragStart=i=>{this.emitter.trigger("dragstart",i),this.handleMove(i,!0)},this.handleDragMove=i=>{this.emitter.trigger("dragmove",i),this.handleMove(i)},this.handlePointerUp=i=>{this.releaseHits(),this.emitter.trigger("pointerup",i)},this.handleDragEnd=i=>{this.movingHit&&this.emitter.trigger("hitupdate",null,!0,i),this.finalHit=this.movingHit,this.movingHit=null,this.emitter.trigger("dragend",i)},this.droppableStore=t,e.emitter.on("pointerdown",this.handlePointerDown),e.emitter.on("dragstart",this.handleDragStart),e.emitter.on("dragmove",this.handleDragMove),e.emitter.on("pointerup",this.handlePointerUp),e.emitter.on("dragend",this.handleDragEnd),this.dragging=e,this.emitter=new Z}processFirstCoord(e){let t={left:e.pageX,top:e.pageY},i=t,n=e.subjectEl,l;n instanceof HTMLElement&&(l=J(n),i=ve(i,l));let s=this.initialHit=this.queryHitForOffset(i.left,i.top);if(s){if(this.useSubjectCenter&&l){let r=me(l,s.rect);r&&(i=Se(r))}this.coordAdjust=De(i,t)}else this.coordAdjust={left:0,top:0}}handleMove(e,t){let i=this.queryHitForOffset(e.pageX+this.coordAdjust.left,e.pageY+this.coordAdjust.top);(t||!L(this.movingHit,i))&&(this.movingHit=i,this.emitter.trigger("hitupdate",i,!1,e))}prepareHits(){this.offsetTrackers=we(this.droppableStore,e=>(e.component.prepareHits(),new qe(e.el)))}releaseHits(){let{offsetTrackers:e}=this;for(let t in e)e[t].destroy();this.offsetTrackers={}}queryHitForOffset(e,t){let{droppableStore:i,offsetTrackers:n}=this,l=null;for(let s in i){let r=i[s].component,a=n[s];if(a&&a.isWithinClipping(e,t)){let o=a.computeLeft(),d=a.computeTop(),c=e-o,g=t-d,{origRect:p}=a,E=p.right-p.left,u=p.bottom-p.top;if(c>=0&&c<E&&g>=0&&g<u){let f=r.queryHit(c,g,E,u);f&&ye(f.dateProfile.activeRange,f.dateSpan.range)&&(this.disablePointCheck||a.el.contains(document.elementFromPoint(c+o-window.scrollX,g+d-window.scrollY)))&&(!l||f.layer>l.layer)&&(f.componentId=s,f.context=r.context,f.rect.left+=o,f.rect.right+=o,f.rect.top+=d,f.rect.bottom+=d,l=f)}}}return l}}function L(h,e){return!h&&!e?!0:!!h!=!!e?!1:Te(h.dateSpan,e.dateSpan)}function q(h,e){let t={};for(let i of e.pluginHooks.datePointTransforms)Object.assign(t,i(h,e));return Object.assign(t,ke(h,e.dateEnv)),t}function ke(h,e){return{date:e.toDate(h.range.start),dateStr:e.formatIso(h.range.start,{omitTime:h.allDay}),allDay:h.allDay}}class Fe extends x{constructor(e){super(e),this.handlePointerDown=i=>{let{dragging:n}=this,l=i.origEvent.target;n.setIgnoreMove(!this.component.isValidDateDownEl(l))},this.handleDragEnd=i=>{let{component:n}=this,{pointer:l}=this.dragging;if(!l.wasTouchScroll){let{initialHit:s,finalHit:r}=this.hitDragging;if(s&&r&&L(s,r)){let{context:a}=n,o=Object.assign(Object.assign({},q(s.dateSpan,a)),{dayEl:s.dayEl,jsEvent:i.origEvent,view:a.viewApi||a.calendarApi.view});a.emitter.trigger("dateClick",o)}}},this.dragging=new w(e.el),this.dragging.autoScroller.isEnabled=!1;let t=this.hitDragging=new T(this.dragging,O(e));t.emitter.on("pointerdown",this.handlePointerDown),t.emitter.on("dragend",this.handleDragEnd)}destroy(){this.dragging.destroy()}}class Ge extends x{constructor(e){super(e),this.dragSelection=null,this.handlePointerDown=s=>{let{component:r,dragging:a}=this,{options:o}=r.context,d=o.selectable&&r.isValidDateDownEl(s.origEvent.target);a.setIgnoreMove(!d),a.delay=s.isTouch?ze(r):null},this.handleDragStart=s=>{this.component.context.calendarApi.unselect(s)},this.handleHitUpdate=(s,r)=>{let{context:a}=this.component,o=null,d=!1;if(s){let c=this.hitDragging.initialHit;s.componentId===c.componentId&&this.isHitComboAllowed&&!this.isHitComboAllowed(c,s)||(o=Be(c,s,a.pluginHooks.dateSelectionTransformers)),(!o||!be(o,s.dateProfile,a))&&(d=!0,o=null)}o?a.dispatch({type:"SELECT_DATES",selection:o}):r||a.dispatch({type:"UNSELECT_DATES"}),d?j():P(),r||(this.dragSelection=o)},this.handlePointerUp=s=>{this.dragSelection&&(Me(this.dragSelection,s,this.component.context),this.dragSelection=null)};let{component:t}=e,{options:i}=t.context,n=this.dragging=new w(e.el);n.touchScrollAllowed=!1,n.minDistance=i.selectMinDistance||0,n.autoScroller.isEnabled=i.dragScroll;let l=this.hitDragging=new T(this.dragging,O(e));l.emitter.on("pointerdown",this.handlePointerDown),l.emitter.on("dragstart",this.handleDragStart),l.emitter.on("hitupdate",this.handleHitUpdate),l.emitter.on("pointerup",this.handlePointerUp)}destroy(){this.dragging.destroy()}}function ze(h){let{options:e}=h.context,t=e.selectLongPressDelay;return t==null&&(t=e.longPressDelay),t}function Be(h,e,t){let i=h.dateSpan,n=e.dateSpan,l=[i.range.start,i.range.end,n.range.start,n.range.end];l.sort(Ae);let s={};for(let r of t){let a=r(h,e);if(a===!1)return null;a&&Object.assign(s,a)}return s.range={start:l[0],end:l[3]},s.allDay=i.allDay,s}class b extends x{constructor(e){super(e),this.subjectEl=null,this.subjectSeg=null,this.isDragging=!1,this.eventRange=null,this.relevantEvents=null,this.receivingContext=null,this.validMutation=null,this.mutatedRelevantEvents=null,this.handlePointerDown=s=>{let r=s.origEvent.target,{component:a,dragging:o}=this,{mirror:d}=o,{options:c}=a.context,g=a.context;this.subjectEl=s.subjectEl;let p=this.subjectSeg=Y(s.subjectEl),u=(this.eventRange=p.eventRange).instance.instanceId;this.relevantEvents=K(g.getCurrentData().eventStore,u),o.minDistance=s.isTouch?0:c.eventDragMinDistance,o.delay=s.isTouch&&u!==a.props.eventSelection?Je(a):null,c.fixedMirrorParent?d.parentNode=c.fixedMirrorParent:d.parentNode=D(r,".fc"),d.revertDuration=c.dragRevertDuration;let f=a.isValidSegDownEl(r)&&!D(r,".fc-event-resizer");o.setIgnoreMove(!f),this.isDragging=f&&s.subjectEl.classList.contains("fc-event-draggable")},this.handleDragStart=s=>{let r=this.component.context,a=this.eventRange,o=a.instance.instanceId;s.isTouch?o!==this.component.props.eventSelection&&r.dispatch({type:"SELECT_EVENT",eventInstanceId:o}):r.dispatch({type:"UNSELECT_EVENT"}),this.isDragging&&(r.calendarApi.unselect(s),r.emitter.trigger("eventDragStart",{el:this.subjectEl,event:new m(r,a.def,a.instance),jsEvent:s.origEvent,view:r.viewApi}))},this.handleHitUpdate=(s,r)=>{if(!this.isDragging)return;let a=this.relevantEvents,o=this.hitDragging.initialHit,d=this.component.context,c=null,g=null,p=null,E=!1,u={affectedEvents:a,mutatedEvents:S(),isEvent:!0};if(s){c=s.context;let f=c.options;d===c||f.editable&&f.droppable?(g=Ze(o,s,this.eventRange.instance.range.start,c.getCurrentData().pluginHooks.eventDragMutationMassagers),g&&(p=Q(a,c.getCurrentData().eventUiBases,g,c),u.mutatedEvents=p,_(u,s.dateProfile,c)||(E=!0,g=null,p=null,u.mutatedEvents=S()))):c=null}this.displayDrag(c,u),E?j():P(),r||(d===c&&L(o,s)&&(g=null),this.dragging.setMirrorNeedsRevert(!g),this.dragging.setMirrorIsVisible(!s||!this.subjectEl.getRootNode().querySelector(".fc-event-mirror")),this.receivingContext=c,this.validMutation=g,this.mutatedRelevantEvents=p)},this.handlePointerUp=()=>{this.isDragging||this.cleanup()},this.handleDragEnd=s=>{if(this.isDragging){let r=this.component.context,a=r.viewApi,{receivingContext:o,validMutation:d}=this,c=this.eventRange.def,g=this.eventRange.instance,p=new m(r,c,g),E=this.relevantEvents,u=this.mutatedRelevantEvents,{finalHit:f}=this.hitDragging;if(this.clearDrag(),r.emitter.trigger("eventDragStop",{el:this.subjectEl,event:p,jsEvent:s.origEvent,view:a}),d){if(o===r){let M=new m(r,u.defs[c.defId],g?u.instances[g.instanceId]:null);r.dispatch({type:"MERGE_EVENTS",eventStore:u});let R={oldEvent:p,event:M,relatedEvents:C(u,r,g),revert(){r.dispatch({type:"MERGE_EVENTS",eventStore:E})}},y={};for(let H of r.getCurrentData().pluginHooks.eventDropTransformers)Object.assign(y,H(d,r));r.emitter.trigger("eventDrop",Object.assign(Object.assign(Object.assign({},R),y),{el:s.subjectEl,delta:d.datesDelta,jsEvent:s.origEvent,view:a})),r.emitter.trigger("eventChange",R)}else if(o){let M={event:p,relatedEvents:C(E,r,g),revert(){r.dispatch({type:"MERGE_EVENTS",eventStore:E})}};r.emitter.trigger("eventLeave",Object.assign(Object.assign({},M),{draggedEl:s.subjectEl,view:a})),r.dispatch({type:"REMOVE_EVENTS",eventStore:E}),r.emitter.trigger("eventRemove",M);let R=u.defs[c.defId],y=u.instances[g.instanceId],H=new m(o,R,y);o.dispatch({type:"MERGE_EVENTS",eventStore:u});let W={event:H,relatedEvents:C(u,o,y),revert(){o.dispatch({type:"REMOVE_EVENTS",eventStore:u})}};o.emitter.trigger("eventAdd",W),s.isTouch&&o.dispatch({type:"SELECT_EVENT",eventInstanceId:g.instanceId}),o.emitter.trigger("drop",Object.assign(Object.assign({},q(f.dateSpan,o)),{draggedEl:s.subjectEl,jsEvent:s.origEvent,view:f.context.viewApi})),o.emitter.trigger("eventReceive",Object.assign(Object.assign({},W),{draggedEl:s.subjectEl,view:f.context.viewApi}))}}else r.emitter.trigger("_noEventDrop")}this.cleanup()};let{component:t}=this,{options:i}=t.context,n=this.dragging=new w(e.el);n.pointer.selector=b.SELECTOR,n.touchScrollAllowed=!1,n.autoScroller.isEnabled=i.dragScroll;let l=this.hitDragging=new T(this.dragging,B);l.useSubjectCenter=e.useEventCenter,l.emitter.on("pointerdown",this.handlePointerDown),l.emitter.on("dragstart",this.handleDragStart),l.emitter.on("hitupdate",this.handleHitUpdate),l.emitter.on("pointerup",this.handlePointerUp),l.emitter.on("dragend",this.handleDragEnd)}destroy(){this.dragging.destroy()}displayDrag(e,t){let i=this.component.context,n=this.receivingContext;n&&n!==e&&(n===i?n.dispatch({type:"SET_EVENT_DRAG",state:{affectedEvents:t.affectedEvents,mutatedEvents:S(),isEvent:!0}}):n.dispatch({type:"UNSET_EVENT_DRAG"})),e&&e.dispatch({type:"SET_EVENT_DRAG",state:t})}clearDrag(){let e=this.component.context,{receivingContext:t}=this;t&&t.dispatch({type:"UNSET_EVENT_DRAG"}),e!==t&&e.dispatch({type:"UNSET_EVENT_DRAG"})}cleanup(){this.subjectSeg=null,this.isDragging=!1,this.eventRange=null,this.relevantEvents=null,this.receivingContext=null,this.validMutation=null,this.mutatedRelevantEvents=null}}b.SELECTOR=".fc-event-draggable, .fc-event-resizable";function Ze(h,e,t,i){let n=h.dateSpan,l=e.dateSpan,s=n.range.start,r=l.range.start,a={};n.allDay!==l.allDay&&(a.allDay=l.allDay,a.hasEnd=e.context.options.allDayMaintainDuration,l.allDay?s=Re(t):s=t);let o=$(s,r,h.context.dateEnv,h.componentId===e.componentId?h.largeUnit:null);o.milliseconds&&(a.allDay=!1);let d={datesDelta:o,standardProps:a};for(let c of i)c(d,h,e);return d}function Je(h){let{options:e}=h.context,t=e.eventLongPressDelay;return t==null&&(t=e.longPressDelay),t}class Ke extends x{constructor(e){super(e),this.draggingSegEl=null,this.draggingSeg=null,this.eventRange=null,this.relevantEvents=null,this.validMutation=null,this.mutatedRelevantEvents=null,this.handlePointerDown=l=>{let{component:s}=this,r=this.querySegEl(l),a=Y(r),o=this.eventRange=a.eventRange;this.dragging.minDistance=s.context.options.eventDragMinDistance,this.dragging.setIgnoreMove(!this.component.isValidSegDownEl(l.origEvent.target)||l.isTouch&&this.component.props.eventSelection!==o.instance.instanceId)},this.handleDragStart=l=>{let{context:s}=this.component,r=this.eventRange;this.relevantEvents=K(s.getCurrentData().eventStore,this.eventRange.instance.instanceId);let a=this.querySegEl(l);this.draggingSegEl=a,this.draggingSeg=Y(a),s.calendarApi.unselect(),s.emitter.trigger("eventResizeStart",{el:a,event:new m(s,r.def,r.instance),jsEvent:l.origEvent,view:s.viewApi})},this.handleHitUpdate=(l,s,r)=>{let{context:a}=this.component,o=this.relevantEvents,d=this.hitDragging.initialHit,c=this.eventRange.instance,g=null,p=null,E=!1,u={affectedEvents:o,mutatedEvents:S(),isEvent:!0};l&&(l.componentId===d.componentId&&this.isHitComboAllowed&&!this.isHitComboAllowed(d,l)||(g=Qe(d,l,r.subjectEl.classList.contains("fc-event-resizer-start"),c.range))),g&&(p=Q(o,a.getCurrentData().eventUiBases,g,a),u.mutatedEvents=p,_(u,l.dateProfile,a)||(E=!0,g=null,p=null,u.mutatedEvents=null)),p?a.dispatch({type:"SET_EVENT_RESIZE",state:u}):a.dispatch({type:"UNSET_EVENT_RESIZE"}),E?j():P(),s||(g&&L(d,l)&&(g=null),this.validMutation=g,this.mutatedRelevantEvents=p)},this.handleDragEnd=l=>{let{context:s}=this.component,r=this.eventRange.def,a=this.eventRange.instance,o=new m(s,r,a),d=this.relevantEvents,c=this.mutatedRelevantEvents;if(s.emitter.trigger("eventResizeStop",{el:this.draggingSegEl,event:o,jsEvent:l.origEvent,view:s.viewApi}),this.validMutation){let g=new m(s,c.defs[r.defId],a?c.instances[a.instanceId]:null);s.dispatch({type:"MERGE_EVENTS",eventStore:c});let p={oldEvent:o,event:g,relatedEvents:C(c,s,a),revert(){s.dispatch({type:"MERGE_EVENTS",eventStore:d})}};s.emitter.trigger("eventResize",Object.assign(Object.assign({},p),{el:this.draggingSegEl,startDelta:this.validMutation.startDelta||G(0),endDelta:this.validMutation.endDelta||G(0),jsEvent:l.origEvent,view:s.viewApi})),s.emitter.trigger("eventChange",p)}else s.emitter.trigger("_noEventResize");this.draggingSeg=null,this.relevantEvents=null,this.validMutation=null};let{component:t}=e,i=this.dragging=new w(e.el);i.pointer.selector=".fc-event-resizer",i.touchScrollAllowed=!1,i.autoScroller.isEnabled=t.context.options.dragScroll;let n=this.hitDragging=new T(this.dragging,O(e));n.emitter.on("pointerdown",this.handlePointerDown),n.emitter.on("dragstart",this.handleDragStart),n.emitter.on("hitupdate",this.handleHitUpdate),n.emitter.on("dragend",this.handleDragEnd)}destroy(){this.dragging.destroy()}querySegEl(e){return D(e.subjectEl,".fc-event")}}function Qe(h,e,t,i){let n=h.context.dateEnv,l=h.dateSpan.range.start,s=e.dateSpan.range.start,r=$(l,s,n,h.largeUnit);if(t){if(n.add(i.start,r)<i.end)return{startDelta:r}}else if(n.add(i.end,r)>i.start)return{endDelta:r};return null}class $e{constructor(e){this.context=e,this.isRecentPointerDateSelect=!1,this.matchesCancel=!1,this.matchesEvent=!1,this.onSelect=i=>{i.jsEvent&&(this.isRecentPointerDateSelect=!0)},this.onDocumentPointerDown=i=>{let n=this.context.options.unselectCancel,l=Ce(i.origEvent);this.matchesCancel=!!D(l,n),this.matchesEvent=!!D(l,b.SELECTOR)},this.onDocumentPointerUp=i=>{let{context:n}=this,{documentPointer:l}=this,s=n.getCurrentData();if(!l.wasTouchScroll){if(s.dateSelection&&!this.isRecentPointerDateSelect){let r=n.options.unselectAuto;r&&(!r||!this.matchesCancel)&&n.calendarApi.unselect(i)}s.eventSelection&&!this.matchesEvent&&n.dispatch({type:"UNSELECT_EVENT"})}this.isRecentPointerDateSelect=!1};let t=this.documentPointer=new ee(document);t.shouldIgnoreMove=!0,t.shouldWatchScroll=!1,t.emitter.on("pointerdown",this.onDocumentPointerDown),t.emitter.on("pointerup",this.onDocumentPointerUp),e.emitter.on("select",this.onSelect)}destroy(){this.context.emitter.off("select",this.onSelect),this.documentPointer.destroy()}}const et={fixedMirrorParent:v},tt={dateClick:v,eventDragStart:v,eventDragStop:v,eventDrop:v,eventResizeStart:v,eventResizeStop:v,eventResize:v,drop:v,eventReceive:v,eventLeave:v};class it{constructor(e,t){this.receivingContext=null,this.droppableEvent=null,this.suppliedDragMeta=null,this.dragMeta=null,this.handleDragStart=n=>{this.dragMeta=this.buildDragMeta(n.subjectEl)},this.handleHitUpdate=(n,l,s)=>{let{dragging:r}=this.hitDragging,a=null,o=null,d=!1,c={affectedEvents:S(),mutatedEvents:S(),isEvent:this.dragMeta.create};n&&(a=n.context,this.canDropElOnCalendar(s.subjectEl,a)&&(o=nt(n.dateSpan,this.dragMeta,a),c.mutatedEvents=F(o),d=!_(c,n.dateProfile,a),d&&(c.mutatedEvents=S(),o=null))),this.displayDrag(a,c),r.setMirrorIsVisible(l||!o||!document.querySelector(".fc-event-mirror")),d?j():P(),l||(r.setMirrorNeedsRevert(!o),this.receivingContext=a,this.droppableEvent=o)},this.handleDragEnd=n=>{let{receivingContext:l,droppableEvent:s}=this;if(this.clearDrag(),l&&s){let r=this.hitDragging.finalHit,a=r.context.viewApi,o=this.dragMeta;if(l.emitter.trigger("drop",Object.assign(Object.assign({},q(r.dateSpan,l)),{draggedEl:n.subjectEl,jsEvent:n.origEvent,view:a})),o.create){let d=F(s);l.dispatch({type:"MERGE_EVENTS",eventStore:d}),n.isTouch&&l.dispatch({type:"SELECT_EVENT",eventInstanceId:s.instance.instanceId}),l.emitter.trigger("eventReceive",{event:new m(l,s.def,s.instance),relatedEvents:[],revert(){l.dispatch({type:"REMOVE_EVENTS",eventStore:d})},draggedEl:n.subjectEl,view:a})}}this.receivingContext=null,this.droppableEvent=null};let i=this.hitDragging=new T(e,B);i.requireInitial=!1,i.emitter.on("dragstart",this.handleDragStart),i.emitter.on("hitupdate",this.handleHitUpdate),i.emitter.on("dragend",this.handleDragEnd),this.suppliedDragMeta=t}buildDragMeta(e){return typeof this.suppliedDragMeta=="object"?V(this.suppliedDragMeta):typeof this.suppliedDragMeta=="function"?V(this.suppliedDragMeta(e)):st(e)}displayDrag(e,t){let i=this.receivingContext;i&&i!==e&&i.dispatch({type:"UNSET_EVENT_DRAG"}),e&&e.dispatch({type:"SET_EVENT_DRAG",state:t})}clearDrag(){this.receivingContext&&this.receivingContext.dispatch({type:"UNSET_EVENT_DRAG"})}canDropElOnCalendar(e,t){let i=t.options.dropAccept;return typeof i=="function"?i.call(t.calendarApi,e):typeof i=="string"&&i?!!ce(e,i):!0}}function nt(h,e,t){let i=Object.assign({},e.leftoverProps);for(let d of t.pluginHooks.externalDefTransforms)Object.assign(i,d(h,e));let{refined:n,extra:l}=de(i,t),s=ge(n,l,e.sourceId,h.allDay,t.options.forceEventDuration||!!e.duration,t),r=h.range.start;h.allDay&&e.startTime&&(r=t.dateEnv.add(r,e.startTime));let a=e.duration?t.dateEnv.add(r,e.duration):ue(h.allDay,r,t),o=pe(s.defId,{start:r,end:a});return{def:s,instance:o}}function st(h){let e=rt(h,"event"),t=e?JSON.parse(e):{create:!1};return V(t)}A.dataAttrPrefix="";function rt(h,e){let t=A.dataAttrPrefix,i=(t?t+"-":"")+e;return h.getAttribute("data-"+i)||""}class lt{constructor(e,t={}){this.handlePointerDown=n=>{let{dragging:l}=this,{minDistance:s,longPressDelay:r}=this.settings;l.minDistance=s??(n.isTouch?0:k.eventDragMinDistance),l.delay=n.isTouch?r??k.longPressDelay:0},this.handleDragStart=n=>{n.isTouch&&this.dragging.delay&&n.subjectEl.classList.contains("fc-event")&&this.dragging.mirror.getMirrorEl().classList.add("fc-event-selected")},this.settings=t;let i=this.dragging=new w(e);i.touchScrollAllowed=!1,t.itemSelector!=null&&(i.pointer.selector=t.itemSelector),t.appendTo!=null&&(i.mirror.parentNode=t.appendTo),i.emitter.on("pointerdown",this.handlePointerDown),i.emitter.on("dragstart",this.handleDragStart),new it(i,t.eventData)}destroy(){this.dragging.destroy()}}var at=se({name:"@fullcalendar/interaction",componentInteractions:[Fe,Ge,b,Ke],calendarInteractions:[$e],elementDraggingImpl:w,optionRefiners:et,listenerRefiners:tt});window.interactionPlugin=at;window.Draggable=lt;
