(function () {
    'use strict';

    var COFFEE_RATIO_G_PER_CUP = 15;
    var WATER_ML_PER_CUP = 250;
    var BLOOM_RATIO = 2;

    var state = {
        cups: 2,
        coffee: 0,
        water: 0,
        bloomWater: 0,
        pour1Water: 0,
        pour2Water: 0,
        stepIndex: 0,
        steps: [],
        universalStart: null,
        universalInterval: null,
        stepInterval: null,
        stepEndsAt: null,
        autoAdvance: true
    };

    function pad(n) {
        return n < 10 ? '0' + n : '' + n;
    }

    function formatTime(ms) {
        if (ms < 0) ms = 0;
        var total = Math.floor(ms / 1000);
        var m = Math.floor(total / 60);
        var s = total % 60;
        return pad(m) + ':' + pad(s);
    }

    function buildRecipe(cups) {
        var coffee = Math.round(cups * COFFEE_RATIO_G_PER_CUP);
        var water = cups * WATER_ML_PER_CUP;
        var bloomWater = coffee * BLOOM_RATIO;
        var afterBloom = water - bloomWater;
        var pour1Water = bloomWater + Math.round(afterBloom * 0.55);
        var pour2Water = water;

        return {
            coffee: coffee,
            water: water,
            bloomWater: bloomWater,
            pour1Water: pour1Water,
            pour2Water: pour2Water
        };
    }

    function buildSteps(recipe) {
        return [
            {
                title: 'Rinse the filter',
                meta: 'Prep',
                duration: 30,
                description: 'Place the filter in the Chemex with the triple-fold side against the spout. Rinse thoroughly with hot water to remove paper taste and pre-heat the glass. Discard the rinse water.',
                pour: null
            },
            {
                title: 'Add the grounds',
                meta: 'Prep',
                duration: 20,
                description: 'Add ' + recipe.coffee + 'g of medium-coarse ground coffee. Give the Chemex a gentle shake to level the bed.',
                pour: recipe.coffee + 'g coffee'
            },
            {
                title: 'Bloom',
                meta: 'Pour 1 of 3',
                duration: 45,
                description: 'Start your timer. Pour just enough water to saturate all the grounds — about 2x the coffee weight. Pour in a spiral from the center outward. Watch the bed puff up.',
                pour: 'Pour to ' + recipe.bloomWater + 'g · wait 45s'
            },
            {
                title: 'First main pour',
                meta: 'Pour 2 of 3',
                duration: 45,
                description: 'Pour slowly in concentric circles, keeping the water level steady. Avoid pouring directly on the filter wall.',
                pour: 'Pour to ' + recipe.pour1Water + 'g'
            },
            {
                title: 'Final pour',
                meta: 'Pour 3 of 3',
                duration: 60,
                description: 'Continue pouring in slow spirals until you reach the target weight. Aim to finish pouring by ~3:00.',
                pour: 'Pour to ' + recipe.pour2Water + 'g'
            },
            {
                title: 'Drawdown',
                meta: 'Final',
                duration: 90,
                description: 'Let the water draw down completely. Total brew time should be around 4:00–4:30. Give the Chemex a gentle swirl to level the bed, then discard the filter and serve.',
                pour: null
            }
        ];
    }

    function $(sel, root) {
        return (root || document).querySelector(sel);
    }

    function $all(sel, root) {
        return Array.prototype.slice.call((root || document).querySelectorAll(sel));
    }

    function openModal() {
        $('.chemex-brew-overlay').classList.add('is-open');
        showStage('setup');
    }

    function closeModal() {
        clearAllTimers();
        $('.chemex-brew-overlay').classList.remove('is-open');
        state.stepIndex = 0;
    }

    function showStage(name) {
        $all('.chemex-brew-stage').forEach(function (el) {
            el.classList.remove('is-active');
        });
        $('.chemex-brew-stage[data-stage="' + name + '"]').classList.add('is-active');
    }

    function clearAllTimers() {
        if (state.universalInterval) {
            clearInterval(state.universalInterval);
            state.universalInterval = null;
        }
        if (state.stepInterval) {
            clearInterval(state.stepInterval);
            state.stepInterval = null;
        }
        state.universalStart = null;
        state.stepEndsAt = null;
    }

    function startUniversalTimer() {
        state.universalStart = Date.now();
        var el = $('.chemex-timer-universal .chemex-timer-value');
        el.textContent = '00:00';
        state.universalInterval = setInterval(function () {
            var elapsed = Date.now() - state.universalStart;
            el.textContent = formatTime(elapsed);
        }, 250);
    }

    function startStepTimer(seconds) {
        if (state.stepInterval) clearInterval(state.stepInterval);
        state.stepEndsAt = Date.now() + seconds * 1000;
        var el = $('.chemex-timer-step .chemex-timer-value');
        el.textContent = formatTime(seconds * 1000);
        state.stepInterval = setInterval(function () {
            var remaining = state.stepEndsAt - Date.now();
            if (remaining <= 0) {
                remaining = 0;
                clearInterval(state.stepInterval);
                state.stepInterval = null;
                onStepTimerEnd();
            }
            el.textContent = formatTime(remaining);
        }, 250);
    }

    function onStepTimerEnd() {
        ding();
        var nextBtn = $('.chemex-next');
        nextBtn.classList.add('chemex-btn');
        nextBtn.textContent = state.stepIndex === state.steps.length - 1 ? 'Finish' : 'Next step';

        if (state.autoAdvance) {
            setTimeout(function () {
                advanceStep();
            }, 800);
        }
    }

    function ding() {
        try {
            var ctx = new (window.AudioContext || window.webkitAudioContext)();
            var o = ctx.createOscillator();
            var g = ctx.createGain();
            o.connect(g);
            g.connect(ctx.destination);
            o.type = 'sine';
            o.frequency.value = 880;
            g.gain.setValueAtTime(0.0001, ctx.currentTime);
            g.gain.exponentialRampToValueAtTime(0.25, ctx.currentTime + 0.02);
            g.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + 0.6);
            o.start();
            o.stop(ctx.currentTime + 0.65);
        } catch (e) {
            // Audio context not available — silently skip
        }
    }

    function renderProgress() {
        var container = $('.chemex-progress');
        container.innerHTML = '';
        state.steps.forEach(function (_, i) {
            var dot = document.createElement('div');
            dot.className = 'chemex-progress-dot';
            if (i < state.stepIndex) dot.classList.add('is-done');
            if (i === state.stepIndex) dot.classList.add('is-current');
            container.appendChild(dot);
        });
    }

    function renderStep() {
        var step = state.steps[state.stepIndex];
        $('.chemex-step-meta').textContent = 'Step ' + (state.stepIndex + 1) + ' of ' + state.steps.length + ' · ' + step.meta;
        $('.chemex-step-title').textContent = step.title;
        $('.chemex-step-desc').textContent = step.description;

        var pourEl = $('.chemex-pour');
        if (step.pour) {
            pourEl.style.display = 'inline-block';
            pourEl.textContent = step.pour;
        } else {
            pourEl.style.display = 'none';
        }

        $('.chemex-prev').disabled = state.stepIndex === 0;
        var nextBtn = $('.chemex-next');
        nextBtn.textContent = state.stepIndex === state.steps.length - 1 ? 'Finish' : 'Next step';

        renderProgress();
        startStepTimer(step.duration);
    }

    function advanceStep() {
        if (state.stepIndex >= state.steps.length - 1) {
            finishBrew();
            return;
        }
        state.stepIndex++;
        renderStep();
    }

    function goBack() {
        if (state.stepIndex === 0) return;
        state.stepIndex--;
        renderStep();
    }

    function finishBrew() {
        if (state.stepInterval) {
            clearInterval(state.stepInterval);
            state.stepInterval = null;
        }
        showStage('done');
        var totalEl = $('.chemex-total-time');
        var elapsed = state.universalStart ? Date.now() - state.universalStart : 0;
        totalEl.textContent = formatTime(elapsed);
        if (state.universalInterval) {
            clearInterval(state.universalInterval);
            state.universalInterval = null;
        }
    }

    function startBrew() {
        var cups = parseInt($('#chemex-cups').value, 10);
        if (isNaN(cups) || cups < 1) cups = 1;
        if (cups > 10) cups = 10;
        state.cups = cups;

        var recipe = buildRecipe(cups);
        state.coffee = recipe.coffee;
        state.water = recipe.water;
        state.bloomWater = recipe.bloomWater;
        state.pour1Water = recipe.pour1Water;
        state.pour2Water = recipe.pour2Water;
        state.steps = buildSteps(recipe);
        state.stepIndex = 0;
        state.autoAdvance = $('#chemex-auto-advance').checked;

        showStage('brewing');
        startUniversalTimer();
        renderStep();
    }

    function updateRecipePreview() {
        var cups = parseInt($('#chemex-cups').value, 10);
        if (isNaN(cups) || cups < 1) cups = 1;
        var recipe = buildRecipe(cups);
        $('.chemex-recipe-coffee').textContent = recipe.coffee + 'g';
        $('.chemex-recipe-water').textContent = recipe.water + 'ml';
    }

    function init() {
        var trigger = $('.chemex-brew-trigger');
        if (!trigger) return;

        trigger.addEventListener('click', openModal);
        $('.chemex-close').addEventListener('click', closeModal);
        $('.chemex-brew-overlay').addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && $('.chemex-brew-overlay').classList.contains('is-open')) {
                closeModal();
            }
        });

        $('#chemex-cups').addEventListener('input', updateRecipePreview);
        $('.chemex-start').addEventListener('click', startBrew);
        $('.chemex-next').addEventListener('click', advanceStep);
        $('.chemex-prev').addEventListener('click', goBack);
        $('.chemex-restart').addEventListener('click', function () {
            clearAllTimers();
            showStage('setup');
        });

        updateRecipePreview();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
