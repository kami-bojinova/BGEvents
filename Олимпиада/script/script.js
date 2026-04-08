 //     
 document.addEventListener('DOMContentLoaded', () => {
            const filtersPanel = document.getElementById('filtersPanel');
            const calendarPanel = document.getElementById('calendarPanel');
            

            const offset = 30; 

            function alignPanel(panel) {
              
                const viewportHeight = window.innerHeight;
                const panelHeight = panel.offsetHeight;

                
                panel.style.top = (window.scrollY + (viewportHeight - panelHeight) / 2) + 'px';
            }

           
            alignPanel(filtersPanel);
            alignPanel(calendarPanel);
            filtersPanel.style.visibility = 'visible';
            calendarPanel.style.visibility = 'visible';

            window.addEventListener('resize', () => {
                alignPanel(filtersPanel);
                alignPanel(calendarPanel);
            });
            


            function togglePanel(panel, side) {
                const panelWidth = panel.offsetWidth;
                if (panel.classList.contains('open')) {
                    panel.classList.remove('open');
                    panel.setAttribute('aria-hidden', 'true');
                    if (side === 'left') panel.style.left = -(panelWidth - 33) + 'px'; 
                    else panel.style.right = -(panelWidth - 33) + 'px';
                } else {
                    panel.classList.add('open');
                    panel.setAttribute('aria-hidden', 'false');
                    if (side === 'left') panel.style.left = offset + 'px'; 
                    else panel.style.right = offset + 'px';
                }
            }

            document.querySelector('.left-panel-arrow').addEventListener('click', () => togglePanel(filtersPanel, 'left'));
            document.querySelector('.right-panel-arrow').addEventListener('click', () => togglePanel(calendarPanel, 'right'));

            
        });

    

// Оферти снимки

function myFunction(smallImg)
{
    var fullImg = document.getElementById("big-img");
    fullImg.src = smallImg.src;
}
// Оферти снимки край



// calendar start
document.addEventListener("DOMContentLoaded", () => {
    const monthYearElemnt = document.getElementById('monthYear');
    const datesElemnt = document.getElementById('dates');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const searchBtn = document.querySelector('.btn_cal'); // Бутонът "Търси"

    if (!monthYearElemnt || !datesElemnt) return;

    let currentDate = new Date();
    let selectedDate = null; 

    const updateCalendar = () => {
        const currentYear = currentDate.getFullYear();
        const currentMonth = currentDate.getMonth();

        const firstDay = new Date(currentYear, currentMonth, 1);
        const lastDay = new Date(currentYear, currentMonth + 1, 0);

        const totalDays = lastDay.getDate();
        let firstDayIndex = firstDay.getDay(); 
        firstDayIndex = firstDayIndex === 0 ? 6 : firstDayIndex - 1; 

        let monthYearString = currentDate.toLocaleDateString("bg-BG", {
            month: "long",
            year: "numeric"
        });

        monthYearString = monthYearString.charAt(0).toUpperCase() + monthYearString.slice(1);
        monthYearElemnt.textContent = monthYearString;

        let datesHTML = '';

        for (let i = 0; i < firstDayIndex; i++) {
            datesHTML += `<div class="date inactive"></div>`;
        }

     
        for (let i = 1; i <= totalDays; i++) {
            const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            const isToday = new Date().toDateString() === new Date(currentYear, currentMonth, i).toDateString() ? 'active' : '';
            const isSelected = selectedDate === dateStr ? 'selected' : '';
            
            datesHTML += `<div class="date ${isToday} ${isSelected}" data-date="${dateStr}">${i}</div>`;
        }

        datesElemnt.innerHTML = datesHTML;


        document.querySelectorAll('.date:not(.inactive)').forEach(dateDiv => {
            dateDiv.onclick = () => {
                document.querySelectorAll('.date').forEach(d => d.classList.remove('selected'));
                dateDiv.classList.add('selected');
                selectedDate = dateDiv.getAttribute('data-date');
            };
        });
    };

  
    if (searchBtn) {
        searchBtn.addEventListener('click', () => {
            if (selectedDate) {
                // Пренасочваме към subitiq.php с избраната дата
                window.location.href = `subitiq.php?date=${selectedDate}`;
            } else {
                alert("Моля, изберете дата от календара първо!");
            }
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            currentDate.setMonth(currentDate.getMonth() - 1);
            updateCalendar();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            currentDate.setMonth(currentDate.getMonth() + 1);
            updateCalendar();
        });
    }

    updateCalendar();
});




document.querySelectorAll(".see-more-btn").forEach(btn => {
    btn.addEventListener("click", () => {
        const text = btn.previousElementSibling;

        if (text.classList.contains("expanded")) {
            text.classList.remove("expanded");
            btn.textContent = "See more";
        } else {
            text.classList.add("expanded");
            btn.textContent = "See less";
        }
    });
});



let LogIn = document.querySelector(".container-log-in");
let SignIn = document.querySelector(".container-sign-in");
let UserInfo = document.querySelector(".container-user-info"); 


let closeBtns = document.querySelectorAll(".close-btn"); 


let logInBtn = document.querySelector("#log-in-btn");
let registerBtn = document.querySelector("#register-btn"); 
let userInfoBtn = document.querySelector("#user-info-btn"); 


closeBtns.forEach(btn => {
    btn.onclick = () => {
        LogIn.classList.remove("active");
        SignIn.classList.remove("active");
        UserInfo.classList.remove("active");
    };
});




if (logInBtn) {
    logInBtn.onclick = () => {
        LogIn.classList.toggle("active");
        SignIn.classList.remove("active");
        UserInfo.classList.remove("active");
    };
}


if (registerBtn) {
    registerBtn.onclick = () => {
        SignIn.classList.toggle("active");
        LogIn.classList.remove("active");
        UserInfo.classList.remove("active");
    };
}


if (userInfoBtn) {
    userInfoBtn.onclick = () => {
        UserInfo.classList.toggle("active"); 
        LogIn.classList.remove("active");
        SignIn.classList.remove("active");
    };
}




document.addEventListener('DOMContentLoaded', () => {
    
    const loginBtn = document.getElementById('log-in-btn');
    const profileBtn = document.getElementById('user-info-btn');
    const registerTrigger = document.getElementById('register-btn');
    
    const loginPanel = document.querySelector('.container-log-in');
    const registerPanel = document.querySelector('.container-sign-in');
    const profilePanel = document.querySelector('.container-user-info');
    const closeBtns = document.querySelectorAll('.close-btn');

    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');


    function closeAll() {
        loginPanel.classList.remove('active');
        registerPanel.classList.remove('active');
        profilePanel.classList.remove('active');
    }


    loginBtn.addEventListener('click', () => {
        closeAll();
        loginPanel.classList.add('active');
    });

    
    profileBtn.addEventListener('click', () => {
        closeAll();
        profilePanel.classList.add('active');
    });

  
    registerTrigger.addEventListener('click', () => {
        loginPanel.classList.remove('active');
        registerPanel.classList.add('active');
    });

   
    closeBtns.forEach(btn => btn.addEventListener('click', closeAll));

    
    hamburger.addEventListener('click', () => navMenu.classList.toggle('active'));
});



document.addEventListener("DOMContentLoaded", () => {
    const menu = document.querySelector(".center");
    const menuBTN = document.querySelector("#menu-btn");

    menuBTN.addEventListener("click", () =>{
        menu.classList.toggle("active");
    });

});




    const dash = document.querySelector('.dashboard-left');
    const btn  = document.querySelector('.dash-toggle');

    if (dash && btn) {
      btn.addEventListener('click', () => {
        dash.classList.toggle('open');
        const opened = dash.classList.contains('open');
        btn.setAttribute('aria-expanded', opened ? 'true' : 'false');
      });
    }


  document.addEventListener('click', (e) => {
   
    if (window.matchMedia('(min-width: 451px)').matches) return;

    const idCell = e.target.closest('.event-row .event-id');
    if (!idCell) return;

    const row = idCell.closest('.event-row');
    const detailsRow = row.nextElementSibling;
    if (!detailsRow || !detailsRow.classList.contains('event-details')) return;

    const table = row.closest('table');
    const isOpen = detailsRow.classList.contains('open');

 
    table.querySelectorAll('.event-details.open').forEach(r => r.classList.remove('open'));
    table.querySelectorAll('.event-row.active').forEach(r => r.classList.remove('active'));
    table.classList.remove('has-open');

    
    if (!isOpen) {
      detailsRow.classList.add('open');
      row.classList.add('active');
      table.classList.add('has-open');
    }
  });

  function resetDetailsForDesktop(){
    if (window.matchMedia('(min-width: 451px)').matches) {
      document.querySelectorAll('.event-details.open').forEach(el => el.classList.remove('open'));
      document.querySelectorAll('.event-row.active').forEach(el => el.classList.remove('active'));
      document.querySelectorAll('table.has-open').forEach(el => el.classList.remove('has-open'));
    }
  }

  resetDetailsForDesktop();
  window.addEventListener('resize', resetDetailsForDesktop);
  
   
  
