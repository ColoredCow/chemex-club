<?php
/**
 * Chemex Brew Widget
 *
 * Self-contained: all CSS and JS are inlined so the widget works on the
 * live server without any build step (no grunt, no compiled main.js/style.css).
 * Included globally from footer.php via get_template_part().
 */
?>
<style>
.chemex-brew-trigger {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1100;
    padding: 12px 22px;
    border: none;
    border-radius: 30px;
    background: rgb(158, 103, 60);
    color: rgba(255, 255, 255, 0.95);
    font-family: 'Roboto', sans-serif;
    font-size: 0.95em;
    font-weight: 600;
    letter-spacing: 0.5px;
    cursor: pointer;
    box-shadow: 0 6px 18px rgba(87, 49, 16, 0.25);
    transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
}
.chemex-brew-trigger .fas { margin-right: 8px; }
.chemex-brew-trigger:hover {
    background: rgb(87, 49, 16);
    transform: translateY(-1px);
    box-shadow: 0 10px 22px rgba(87, 49, 16, 0.3);
}
.chemex-brew-trigger:focus { outline: none; }

.chemex-brew-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    z-index: 1200;
    background: rgba(0, 0, 0, 0.6);
    align-items: center;
    justify-content: center;
    padding: 20px;
    font-family: 'Roboto', sans-serif;
}
.chemex-brew-overlay.is-open { display: flex; }

.chemex-brew-modal {
    background: #fff;
    color: rgba(0, 0, 0, 0.84);
    border-radius: 12px;
    width: 100%;
    max-width: 560px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 32px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    position: relative;
    box-sizing: border-box;
}
.chemex-brew-modal h2 {
    font-family: 'EB Garamond', serif;
    color: rgb(87, 49, 16);
    margin: 0 0 8px;
    font-size: 1.9em;
}
.chemex-brew-modal .chemex-subtitle {
    color: #8b8b8b;
    margin: 0 0 24px;
    font-size: 0.95em;
}
.chemex-brew-modal .chemex-close {
    position: absolute;
    top: 14px;
    right: 18px;
    background: none;
    border: none;
    font-size: 1.6em;
    color: #cfd7df;
    cursor: pointer;
    line-height: 1;
}
.chemex-brew-modal .chemex-close:hover { color: rgb(158, 103, 60); }

.chemex-cups-input {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 20px 0 8px;
}
.chemex-cups-input label {
    font-weight: 600;
    color: rgb(87, 49, 16);
    margin: 0;
}
.chemex-cups-input input[type="number"] {
    width: 90px;
    padding: 8px 12px;
    font-size: 1em;
    border: 2px solid rgba(215, 156, 106, 0.3);
    border-radius: 6px;
    font-family: inherit;
}
.chemex-cups-input input[type="number"]:focus {
    outline: none;
    border-color: rgb(158, 103, 60);
}

.chemex-recipe {
    background: rgba(215, 156, 106, 0.3);
    border-radius: 8px;
    padding: 14px 18px;
    margin: 16px 0 24px;
    font-size: 0.95em;
    color: rgb(87, 49, 16);
}
.chemex-recipe span { font-weight: 600; }

.chemex-btn {
    display: inline-block;
    padding: 11px 22px;
    border: none;
    border-radius: 30px;
    background: rgb(158, 103, 60);
    color: #fff;
    font-family: inherit;
    font-size: 0.95em;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.15s ease;
}
.chemex-btn:hover { background: rgb(87, 49, 16); }
.chemex-btn.chemex-btn-ghost {
    background: transparent;
    color: rgb(158, 103, 60);
    border: 2px solid rgb(158, 103, 60);
}
.chemex-btn.chemex-btn-ghost:hover { background: rgba(215, 156, 106, 0.3); }
.chemex-btn:disabled { opacity: 0.5; cursor: not-allowed; }

.chemex-brew-stage { display: none; }
.chemex-brew-stage.is-active { display: block; }

.chemex-timers {
    display: flex;
    gap: 16px;
    justify-content: space-between;
    margin: 8px 0 20px;
}
.chemex-timer {
    flex: 1;
    background: rgba(215, 156, 106, 0.3);
    border-radius: 8px;
    padding: 14px;
    text-align: center;
}
.chemex-timer-label {
    font-size: 0.75em;
    color: rgb(87, 49, 16);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 6px;
}
.chemex-timer-value {
    font-family: 'EB Garamond', serif;
    font-size: 2em;
    font-weight: 700;
    color: rgb(158, 103, 60);
    line-height: 1;
}
.chemex-timer.chemex-timer-step .chemex-timer-value {
    color: rgb(87, 49, 16);
}

.chemex-step-card {
    background: #fff;
    border: 2px solid rgba(215, 156, 106, 0.3);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 16px;
}
.chemex-step-meta {
    font-size: 0.75em;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgb(215, 156, 106);
    font-weight: 700;
    margin-bottom: 6px;
}
.chemex-step-card h3 {
    font-family: 'EB Garamond', serif;
    color: rgb(87, 49, 16);
    font-size: 1.5em;
    margin: 0 0 10px;
}
.chemex-step-card p {
    margin: 0 0 10px;
    line-height: 1.5;
}
.chemex-pour {
    background: rgba(215, 156, 106, 0.3);
    padding: 8px 12px;
    border-radius: 6px;
    font-weight: 600;
    color: rgb(87, 49, 16);
    display: inline-block;
}

.chemex-progress {
    display: flex;
    gap: 6px;
    margin-bottom: 20px;
}
.chemex-progress-dot {
    flex: 1;
    height: 6px;
    border-radius: 3px;
    background: rgba(215, 156, 106, 0.3);
    transition: background 0.2s ease;
}
.chemex-progress-dot.is-done { background: rgb(158, 103, 60); }
.chemex-progress-dot.is-current { background: rgb(215, 156, 106); }

.chemex-actions {
    display: flex;
    gap: 12px;
    justify-content: space-between;
    margin-top: 20px;
}
.chemex-actions-right {
    display: flex;
    gap: 10px;
}

.chemex-complete {
    text-align: center;
    padding: 20px 0;
}
.chemex-complete .fas {
    color: rgb(158, 103, 60);
    font-size: 3em;
    margin-bottom: 12px;
}
.chemex-complete h3 {
    font-family: 'EB Garamond', serif;
    color: rgb(87, 49, 16);
    font-size: 1.8em;
    margin: 0 0 8px;
}
.chemex-complete p {
    color: rgb(87, 49, 16);
    margin: 0 0 20px;
}

@media (max-width: 600px) {
    .chemex-brew-trigger {
        top: 14px; right: 14px;
        padding: 10px 16px; font-size: 0.85em;
    }
    .chemex-brew-modal { padding: 24px 20px; }
    .chemex-brew-modal h2 { font-size: 1.5em; }
    .chemex-timers .chemex-timer .chemex-timer-value { font-size: 1.5em; }
}
</style>

<button type="button" class="chemex-brew-trigger" aria-label="Start a Chemex brew">
    <i class="fas fa-coffee"></i>Brew Chemex
</button>

<div class="chemex-brew-overlay" role="dialog" aria-modal="true" aria-labelledby="chemex-brew-title">
    <div class="chemex-brew-modal">
        <button type="button" class="chemex-close" aria-label="Close">&times;</button>

        <div class="chemex-brew-stage is-active" data-stage="setup">
            <h2 id="chemex-brew-title">Brew a Chemex</h2>
            <p class="chemex-subtitle">Pour-over coffee, guided step by step.</p>

            <div class="chemex-cups-input">
                <label for="chemex-cups">Cups</label>
                <input type="number" id="chemex-cups" min="1" max="10" value="2" />
                <span class="chemex-subtitle">~250ml each</span>
            </div>

            <div class="chemex-recipe">
                You'll need <span class="chemex-recipe-coffee">30g</span> of medium-coarse coffee
                and <span class="chemex-recipe-water">500ml</span> of water at 94-96&deg;C.
            </div>

            <div style="margin: 14px 0 22px;">
                <label style="font-size: 0.9em; color: #573110; cursor: pointer;">
                    <input type="checkbox" id="chemex-auto-advance" checked />
                    Auto-advance when each step's timer ends
                </label>
            </div>

            <div class="chemex-actions">
                <span></span>
                <div class="chemex-actions-right">
                    <button type="button" class="chemex-btn chemex-start">Start brewing</button>
                </div>
            </div>
        </div>

        <div class="chemex-brew-stage" data-stage="brewing">
            <h2>Brewing</h2>
            <div class="chemex-progress"></div>

            <div class="chemex-timers">
                <div class="chemex-timer chemex-timer-universal">
                    <div class="chemex-timer-label">Total</div>
                    <div class="chemex-timer-value">00:00</div>
                </div>
                <div class="chemex-timer chemex-timer-step">
                    <div class="chemex-timer-label">This step</div>
                    <div class="chemex-timer-value">00:00</div>
                </div>
            </div>

            <div class="chemex-step-card">
                <div class="chemex-step-meta">Step 1</div>
                <h3 class="chemex-step-title">&nbsp;</h3>
                <p class="chemex-step-desc">&nbsp;</p>
                <span class="chemex-pour"></span>
            </div>

            <div class="chemex-actions">
                <button type="button" class="chemex-btn chemex-btn-ghost chemex-prev">Back</button>
                <div class="chemex-actions-right">
                    <button type="button" class="chemex-btn chemex-next">Next step</button>
                </div>
            </div>
        </div>

        <div class="chemex-brew-stage" data-stage="done">
            <div class="chemex-complete">
                <i class="fas fa-mug-hot"></i>
                <h3>Your Chemex is ready.</h3>
                <p>Total brew time: <strong class="chemex-total-time">00:00</strong></p>
                <button type="button" class="chemex-btn chemex-restart">Brew another</button>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    var COFFEE_RATIO_G_PER_CUP = 15;
    var WATER_ML_PER_CUP = 250;
    var BLOOM_RATIO = 2;

    var state = {
        cups: 2,
        steps: [],
        stepIndex: 0,
        universalStart: null,
        universalInterval: null,
        stepInterval: null,
        stepEndsAt: null,
        autoAdvance: true
    };

    function pad(n) { return n < 10 ? '0' + n : '' + n; }

    function formatTime(ms) {
        if (ms < 0) ms = 0;
        var total = Math.floor(ms / 1000);
        return pad(Math.floor(total / 60)) + ':' + pad(total % 60);
    }

    function buildRecipe(cups) {
        var coffee = Math.round(cups * COFFEE_RATIO_G_PER_CUP);
        var water = cups * WATER_ML_PER_CUP;
        var bloomWater = coffee * BLOOM_RATIO;
        var afterBloom = water - bloomWater;
        return {
            coffee: coffee,
            water: water,
            bloomWater: bloomWater,
            pour1Water: bloomWater + Math.round(afterBloom * 0.55),
            pour2Water: water
        };
    }

    function buildSteps(recipe) {
        return [
            { title: 'Rinse the filter', meta: 'Prep', duration: 30,
              description: 'Place the filter in the Chemex with the triple-fold side against the spout. Rinse thoroughly with hot water to remove paper taste and pre-heat the glass. Discard the rinse water.',
              pour: null },
            { title: 'Add the grounds', meta: 'Prep', duration: 20,
              description: 'Add ' + recipe.coffee + 'g of medium-coarse ground coffee. Give the Chemex a gentle shake to level the bed.',
              pour: recipe.coffee + 'g coffee' },
            { title: 'Bloom', meta: 'Pour 1 of 3', duration: 45,
              description: 'Start your timer. Pour just enough water to saturate all the grounds - about 2x the coffee weight. Pour in a spiral from the center outward. Watch the bed puff up.',
              pour: 'Pour to ' + recipe.bloomWater + 'g - wait 45s' },
            { title: 'First main pour', meta: 'Pour 2 of 3', duration: 45,
              description: 'Pour slowly in concentric circles, keeping the water level steady. Avoid pouring directly on the filter wall.',
              pour: 'Pour to ' + recipe.pour1Water + 'g' },
            { title: 'Final pour', meta: 'Pour 3 of 3', duration: 60,
              description: 'Continue pouring in slow spirals until you reach the target weight. Aim to finish pouring by ~3:00.',
              pour: 'Pour to ' + recipe.pour2Water + 'g' },
            { title: 'Drawdown', meta: 'Final', duration: 90,
              description: 'Let the water draw down completely. Total brew time should be around 4:00-4:30. Give the Chemex a gentle swirl to level the bed, then discard the filter and serve.',
              pour: null }
        ];
    }

    function $(sel, root) { return (root || document).querySelector(sel); }
    function $all(sel, root) { return Array.prototype.slice.call((root || document).querySelectorAll(sel)); }

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
        $all('.chemex-brew-stage').forEach(function (el) { el.classList.remove('is-active'); });
        $('.chemex-brew-stage[data-stage="' + name + '"]').classList.add('is-active');
    }

    function clearAllTimers() {
        if (state.universalInterval) { clearInterval(state.universalInterval); state.universalInterval = null; }
        if (state.stepInterval) { clearInterval(state.stepInterval); state.stepInterval = null; }
        state.universalStart = null;
        state.stepEndsAt = null;
    }

    function startUniversalTimer() {
        state.universalStart = Date.now();
        var el = $('.chemex-timer-universal .chemex-timer-value');
        el.textContent = '00:00';
        state.universalInterval = setInterval(function () {
            el.textContent = formatTime(Date.now() - state.universalStart);
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
        if (state.autoAdvance) {
            setTimeout(function () { advanceStep(); }, 800);
        }
    }

    function ding() {
        try {
            var ctx = new (window.AudioContext || window.webkitAudioContext)();
            var o = ctx.createOscillator();
            var g = ctx.createGain();
            o.connect(g); g.connect(ctx.destination);
            o.type = 'sine';
            o.frequency.value = 880;
            g.gain.setValueAtTime(0.0001, ctx.currentTime);
            g.gain.exponentialRampToValueAtTime(0.25, ctx.currentTime + 0.02);
            g.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + 0.6);
            o.start();
            o.stop(ctx.currentTime + 0.65);
        } catch (e) {}
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
        $('.chemex-step-meta').textContent = 'Step ' + (state.stepIndex + 1) + ' of ' + state.steps.length + ' - ' + step.meta;
        $('.chemex-step-title').textContent = step.title;
        $('.chemex-step-desc').textContent = step.description;

        var pourEl = $('.chemex-pour');
        if (step.pour) { pourEl.style.display = 'inline-block'; pourEl.textContent = step.pour; }
        else { pourEl.style.display = 'none'; }

        $('.chemex-prev').disabled = state.stepIndex === 0;
        $('.chemex-next').textContent = state.stepIndex === state.steps.length - 1 ? 'Finish' : 'Next step';

        renderProgress();
        startStepTimer(step.duration);
    }

    function advanceStep() {
        if (state.stepIndex >= state.steps.length - 1) { finishBrew(); return; }
        state.stepIndex++;
        renderStep();
    }

    function goBack() {
        if (state.stepIndex === 0) return;
        state.stepIndex--;
        renderStep();
    }

    function finishBrew() {
        if (state.stepInterval) { clearInterval(state.stepInterval); state.stepInterval = null; }
        showStage('done');
        var elapsed = state.universalStart ? Date.now() - state.universalStart : 0;
        $('.chemex-total-time').textContent = formatTime(elapsed);
        if (state.universalInterval) { clearInterval(state.universalInterval); state.universalInterval = null; }
    }

    function startBrew() {
        var cups = parseInt($('#chemex-cups').value, 10);
        if (isNaN(cups) || cups < 1) cups = 1;
        if (cups > 10) cups = 10;
        state.cups = cups;
        state.steps = buildSteps(buildRecipe(cups));
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
        var trigger = document.querySelector('.chemex-brew-trigger');
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
</script>
