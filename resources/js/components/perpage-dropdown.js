document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.perpage-dropdown').forEach(function(root){
        const trigger = root.querySelector('.perpage-trigger');
        const list = root.querySelector('.perpage-list');
        const valueEl = root.querySelector('.perpage-value');
        const route = root.getAttribute('data-route');

        function openList() {
            list.classList.remove('hidden');
            trigger.setAttribute('aria-expanded', 'true');
            list.querySelector('[role="option"]').focus();
            list.setAttribute('aria-hidden', 'false');
        }

        function closeList() {
            list.classList.add('hidden');
            trigger.setAttribute('aria-expanded', 'false');
            list.setAttribute('aria-hidden', 'true');
        }

        trigger.addEventListener('click', function(){
            if (list.classList.contains('hidden')) openList(); else closeList();
        });

        list.addEventListener('click', function(e){
            const li = e.target.closest('[role="option"]');
            if (!li) return;
            const val = li.getAttribute('data-value');
            valueEl.textContent = val;
            closeList();
            // persist via AJAX and reload
            fetch(route, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ per_page: val })
            }).then(()=>{
                const params = new URLSearchParams(window.location.search);
                params.set('per_page', val);
                window.location.search = params.toString();
            });
        });

        list.addEventListener('keydown', function(e){
            if (e.key === 'Escape') { closeList(); trigger.focus(); }
            if (e.key === 'ArrowDown') { e.preventDefault(); if (document.activeElement.nextElementSibling) document.activeElement.nextElementSibling.focus(); }
            if (e.key === 'ArrowUp') { e.preventDefault(); if (document.activeElement.previousElementSibling) document.activeElement.previousElementSibling.focus(); }
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); document.activeElement.click(); }
        });

        document.addEventListener('click', function(e){ if (!root.contains(e.target)) closeList(); });

    });
});
