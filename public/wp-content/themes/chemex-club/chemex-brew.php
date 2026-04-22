<?php
/**
 * Chemex Brew Widget
 *
 * Renders the floating "Brew Chemex" button and the step-by-step
 * brewing wizard modal. Loaded globally from footer.php.
 */
?>
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
                and <span class="chemex-recipe-water">500ml</span> of water at 94–96&deg;C.
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
            <h2 id="chemex-brew-title-brewing">Brewing</h2>
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
