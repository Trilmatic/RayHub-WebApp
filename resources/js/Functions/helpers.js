import TomSelect from "tom-select/dist/js/tom-select.complete.min";
import flatpickr from "flatpickr";

export const debounce = (callback, wait) => {
    var timeoutId = null;
    return (...args) => {
        window.clearTimeout(timeoutId);
        timeoutId = window.setTimeout(() => {
            callback.apply(null, args);
        }, wait);
    };
}

export const back = () => {
    window.history.back();
}

export const initDateFormat = () => {
    if (localStorage.getItem('date-format')) return localStorage.getItem('date-format');
    return navigator.language;
}

export const dateFormat = initDateFormat();

export const formatDateTime = (date) => {
    let init = new Date(date);
    return init.toLocaleString(dateFormat, { dateStyle: 'medium', timeStyle: 'short' });
}

export const formatDate = (date) => {
    let init = new Date(date);
    return init.toLocaleDateString(dateFormat);
}


export const handleColorSchemeToggle = () => {
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    const themeToggleBtn = document.getElementById('theme-toggle');
    const isDarkMode =
        localStorage.getItem('color-theme') === 'dark' ||
        (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);

    const setMode = (isDark) => {
        //Handle theme class and save to local storage
        if (isDark) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }
        // Show the correct icon based on the updated mode
        themeToggleDarkIcon.classList.toggle('hidden', isDark);
        themeToggleLightIcon.classList.toggle('hidden', !isDark);
    }

    const toggleMode = () => {
        const isCurrentlyDarkMode = document.documentElement.classList.contains('dark');
        setMode(!isCurrentlyDarkMode);
    };

    setMode(isDarkMode);

    // Toggle mode on button click
    themeToggleBtn.addEventListener('click', toggleMode);
};

export const createTomSelect = (element, options, defaultValue = null) => {
    const renderItem = (data, escape) => {
        return "<div>" + escape(data[options.searchField || "name"]) + "</div>";
    };
    const tomselect = new TomSelect(element, {
        valueField: options.valueField || "value",
        searchField: options.searchField || "name",
        maxItems: options.maxItems || 1,
        options: options.options,
        render: {
            option: options.renderOption || renderItem,
            item: options.renderSelection || renderItem,
        },
        create: options.create || false
    });
    if (defaultValue) tomselect.addItem(defaultValue);
    if (options.onChange) tomselect.on("change", options.onChange);
    return tomselect;
};

export const createFlatpickr = (element, options) => {
    flatpickr(element, {
        enableTime: options.enableTime || false,
        noCalendar: options.noCalendar || false,
        dateFormat: options.dateFormat || "Y-m-d",
        time_24hr: options.time_24hr || true,
        onChange: options.onChange || null
    });
};
