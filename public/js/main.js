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

    const createServiceCheckbox = document.getElementById('createService');
    const appSelect = document.getElementById('app_select');
    const packageSelect = document.getElementById('package_select');

    function checkbox(){
        if (createServiceCheckbox.checked) {
            appSelect.disabled = false;
            packageSelect.disabled = false;
        } else {
            appSelect.disabled = true;
            packageSelect.disabled = true;

            appSelect.value = "";
            packageSelect.value = "";

            appSelect.classList.remove('is-invalid');
            packageSelect.classList.remove('is-invalid');
        }
    }

    createServiceCheckbox.addEventListener('change', checkbox);

    checkbox();
    //-Giải thích tại sao thêm hàm checkbox ở cuối:  Nhờ hàm old('create_service'), ô checkbox vẫn được tích chọn.

    // Vấn đề: Trình duyệt khi load lại sẽ mặc định các ô < select > ở trạng thái disabled(khóa) như đã viết trong HTML.

    // Giải pháp: Khi bạn gọi handleToggle() ở cuối file JS, ngay khi trang vừa hiện lên, 
    // nó sẽ chạy kiểm tra: checkbox đang tích (do old giữ lại), vậy phải mở khóa các ô select.


  });