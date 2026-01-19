document.addEventListener('DOMContentLoaded', function () {
  
    // const currentPage = window.location.pathname;
    // const menuLinks = document.querySelectorAll(".menu-link");
    
    // menuLinks.forEach(link => {
    //     const href = new URL(link.href).pathname;
    //     if (href === currentPage) {
    //         link.parentElement.classList.add('active');
    //         link.classList.add('active');
    //     }
    // });

    const menuItems = document.querySelectorAll(".menu-item");
    menuItems.forEach(menuItem => {
        menuItem.addEventListener('click', function (e) {
            if (e.target.closest('.menu-link')) {
                return;
            }
            const link = this.querySelector('.menu-link');
            if (link) {
                link.click();
            }
        });
    });

    // ===== Form validation =====
    const form = document.querySelector('form');
    if (!form) return;

    const appName = document.getElementById('appName');
    const appCode = document.getElementById('appCode');
    // const codePattern = /^(?!-)([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/;

    // form.addEventListener('submit', function (e) {
    //   e.preventDefault(); 
    //   appName.classList.remove('is-invalid');
    //   appCode.classList.remove('is-invalid');

    //   if (!appName.value.trim()) {
    //     appName.classList.add('is-invalid');
    //     const errorMessage = appName.nextElementSibling;  
    //     if (errorMessage && errorMessage.classList.contains('invalid-feedback')) {
    //       errorMessage.textContent = 'Vui lòng nhập Tên App.';
    //     }
    //     appName.focus();
    //     return;
    //   }

    //   const code = appCode.value.trim();
    //   if(!code){
    //     appCode.classList.add('is-invalid');
    //     const errorMessage = appCode.nextElementSibling;  
    //     if (errorMessage && errorMessage.classList.contains('invalid-feedback')) {
    //       errorMessage.textContent = 'Vui lòng nhập App Code.';
    //     }
    //     appCode.focus();
    //     return;

    //     // const errorMessage = document.createElement("div");
    //     // errorMessage.classList.add('invalid-feedback');
    //     // errorMessage.textContent = "Vui lòng nhập App Code.";
    //     // appCode.parentElement.appendChild(errorMessage);
    //     //appCode.focus();
    //     // return;
    //   }

    //   // if (!codePattern.test(code)) {
    //   //   appCode.classList.add('is-invalid');
    //   //   const errorMessage = appCode.nextElementSibling;
    //   //   if (errorMessage && errorMessage.classList.contains('invalid-feedback')) {
    //   //     errorMessage.textContent = 'App Code không hợp lệ.';
    //   //   }
    //   //   appCode.focus();
    //   //   // alert('App Code không hợp lệ. Chỉ chấp nhận chữ, số, dấu gạch ngang (-) và gạch dưới (_).');
    //   //   return;
    //   // }
    //   form.submit();
    // });
    
    const cancelBtn = document.querySelector('.btn-secondary');
    if(cancelBtn){
      cancelBtn.addEventListener('click', ()=>{
        form.reset();
        [appName, appCode].forEach(i=> i.classList.remove('is-invalid'));
      });
    }
  });