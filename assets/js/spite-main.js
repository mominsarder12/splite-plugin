// const quotes = document.querySelectorAll(".quote");

// function setupSplits() {
//   quotes.forEach(quote => {
//     // Reset if needed
//     if(quote.anim) {
//       quote.anim.progress(1).kill();
//       quote.split.revert();
//     }

//     quote.split = new SplitText(quote, {
//       type: "lines,words,chars",
//       linesClass: "split-line"
//     });

//     // Set up the anim
//     quote.anim = gsap.from(quote.split.chars, {
//       scrollTrigger: {
//         trigger: quote,
//         toggleActions: "restart pause resume",
//         start: "top 80%",
//       },
//       duration: 0.6,
//       ease: "circ.out",
//       y: 80,
//       stagger: 0.02,
//     });
//   });
// }

// ScrollTrigger.addEventListener("refresh", setupSplits);
// setupSplits();

/**
 * for first scrolling the title mine
 */

// let quotes = document.querySelectorAll(".quote");
// let animationTriggered = false;

// function setupSplits() {
//   if (animationTriggered) {
//     return; // If animation has already been triggered, exit the function.
//   }

//   quotes.forEach((quote) => {
//     quote.split = new SplitText(quote, {
//       type: "lines,words,chars",
//       linesClass: "split-line",
//     });

//     gsap.from(quote.split.chars, {
//       duration: 0.6,
//       ease: "circ.out",
//       y: 80,
//     //   stagger: 0.02,
//     });
//   });

//   // Set the flag to indicate that the animation has been triggered.
//   animationTriggered = true;
// }

// // Use the ScrollTrigger to trigger the animation when the element is in view.
// ScrollTrigger.create({
//   trigger: ".quote", // Change this selector to match the element you want to animate.
//   start: "top 80%", // Adjust this value to control when the animation starts.
//   onEnter: setupSplits,
// });

// // Optionally, you can call setupSplits once on page load to animate if the element is in view initially.
// if (quotes.length > 0 && isElementInViewport(quotes[0])) {
//   setupSplits();
// }

// // Function to check if an element is in the viewport
// function isElementInViewport(el) {
//   const rect = el.getBoundingClientRect();
//   return rect.top >= 0 && rect.bottom <= window.innerHeight;
// }

/******
 * 
 * Fixing Final
 * 
 ******/

const quotes = document.querySelectorAll(".quote");

function setupSplits() {
	quotes.forEach((quote) => {
		// Reset if needed
		if (quote.anim) {
			quote.anim.progress(1).kill();
			quote.split.revert();
		}

		quote.split = new SplitText(quote, {
			type: "lines,words,chars",
			linesClass: "split-line",
		});

		// Set up the anim with ScrollTrigger for the first scroll
		ScrollTrigger.create({
			trigger: quote,
			animation: gsap.from(quote.split.chars, {
				duration: 0.6,
				ease: "circ.out",
				y: 100,
				// stagger: 0.02 
			}),
			once: true, // Only play the animation once
		});
	});
}

gsap.config({ trialWarn: false });

// Call setupSplits on page load
window.addEventListener("load", setupSplits);
