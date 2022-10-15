const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"telegraph.webhook":{"uri":"telegraph\/{token}\/webhook","methods":["POST"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"events":{"uri":"events","methods":["GET","HEAD"]},"events.data":{"uri":"events\/data","methods":["GET","HEAD"]},"events.store":{"uri":"events","methods":["POST"]},"telegram.test":{"uri":"telegram\/test","methods":["GET","HEAD"]},"telegram.webhook":{"uri":"telegram\/webhook","methods":["GET","HEAD"]},"register":{"uri":"register","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"]},"password.update":{"uri":"reset-password","methods":["POST"]},"verification.notice":{"uri":"verify-email","methods":["GET","HEAD"]},"verification.verify":{"uri":"verify-email\/{id}\/{hash}","methods":["GET","HEAD"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirm":{"uri":"confirm-password","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"admin::login":{"uri":"admin\/login","methods":["GET","HEAD"]},"admin::login.validar":{"uri":"admin\/login","methods":["POST"]},"admin::dash":{"uri":"admin","methods":["GET","HEAD"]},"admin::logout":{"uri":"admin\/logout","methods":["GET","HEAD"]},"admin::perfil.ver":{"uri":"admin\/perfil","methods":["GET","HEAD"]},"admin::ordenes.crear":{"uri":"admin\/ordenes\/crear","methods":["GET","HEAD"]},"admin::ordenes.store":{"uri":"admin\/ordenes\/store","methods":["POST"]},"admin::ordenes.show":{"uri":"admin\/ordenes\/{orden}\/show","methods":["GET","HEAD"]},"admin::usuarios.index":{"uri":"admin\/usuarios","methods":["GET","HEAD"]},"admin::usuarios.create":{"uri":"admin\/usuarios\/create","methods":["POST"]},"admin::usuarios.show":{"uri":"admin\/usuarios\/{usuario}\/show","methods":["GET","HEAD"]},"admin::usuarios.edit":{"uri":"admin\/usuarios\/{usuario}\/edit","methods":["GET","HEAD"]},"admin::usuarios.update":{"uri":"admin\/usuarios\/{usuario}\/update","methods":["PUT"]},"admin::usuarios.destroy":{"uri":"admin\/usuarios\/{usuario}\/destroy","methods":["DELETE"]},"admin::servicios.search":{"uri":"admin\/servicios\/search","methods":["POST"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };