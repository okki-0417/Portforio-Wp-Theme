import { use, useEffect, useRef, useState } from "react"
import { BASE_URL } from "./main"

export default function Carousel() {
	const imagePaths = [
		`${BASE_URL}/assets/images/main-visuals/challenger1.jpg`,
		`${BASE_URL}/assets/images/main-visuals/challenger2.jpg`,
		`${BASE_URL}/assets/images/main-visuals/challenger3.jpg`,
	]

	const MIN_CAROUSELABLE_NUM = 2
	if (imagePaths.length < MIN_CAROUSELABLE_NUM) return null

	// [参考](https://qiita.com/wintyo/items/a37a197f69aa205297a5)
	const carouselableImagePaths = [imagePaths[imagePaths.length - 1], ...imagePaths, imagePaths[0]]

	const ACTUAL_FIRST_IMAGE_INDEX = 1
	const ACTUAL_LAST_IMAGE_INDEX = carouselableImagePaths.length - 2
	const MOCK_LAST_IMAGE_INDEX = 0
	const MOCK_FIRST_IMAGE_INDEX = carouselableImagePaths.length - 1

	const [index, setIndex] = useState(ACTUAL_FIRST_IMAGE_INDEX)
	const [isAnimating, setIsAnimating] = useState(true)
	const [isTransitioning, setIsTransitioning] = useState(false)
	const [isLoop] = useState(true)
	const carouselRef = useRef<HTMLDivElement>(null)

	const handleClick = (diff: number) => {
		if (isTransitioning) return
		setIsTransitioning(true)

		setIsAnimating(true)
		setIndex(prev => prev + diff)
	}

	useEffect(() => {
		const carouselContainer = carouselRef.current
		if (!carouselContainer) return

		const handleTransitionEnd = () => {
			if (index >= MOCK_FIRST_IMAGE_INDEX) {
				setIsAnimating(false)
				setIndex(ACTUAL_FIRST_IMAGE_INDEX)
			} else if (index <= MOCK_LAST_IMAGE_INDEX) {
				setIsAnimating(false)
				setIndex(ACTUAL_LAST_IMAGE_INDEX)
			}

			setIsTransitioning(false)
		}

		carouselContainer.addEventListener("transitionend", handleTransitionEnd)
		return () => carouselContainer.removeEventListener("transitionend", handleTransitionEnd)
	}, [index])

	useEffect(() => {
		const LOOP_DURATION = 4000

		if (isLoop) {
			const intervalId = setInterval(() => {
				handleClick(1)
			}, LOOP_DURATION)

			return () => clearInterval(intervalId)
		}
	}, [isLoop])

	return (
		<div className="lg:h-[70vh] h-[40vh] w-screen relative">
			<button
				className="absolute top-1/2 left-36 bg-gray-200 size-12 rounded-full z-10 cursor-pointer"
				onClick={() => handleClick(-1)}
			>
				←
			</button>
			<button
				className="absolute top-1/2 right-36 bg-gray-200 size-12 rounded-full z-10 cursor-pointer"
				onClick={() => handleClick(1)}
			>
				→
			</button>

			<div className="w-screen overflow-hidden">
				<div
					ref={carouselRef}
					className={`h-full flex ${isAnimating ? "transition-all duration-700 ease-in-out" : "transition-none"}`}
					style={{ translate: `${-index * 100}%` }}
				>
					{carouselableImagePaths.map(path => {
						return (
							<div className="w-full h-full shrink-0 flex justify-center items-center">
								<img src={path} alt="" className="h-full object-contain" />
							</div>
						)
					})}
				</div>
			</div>

			<div className="flex justify-center gap-4 absolute bottom-4 inset-x-0">
				{Array(carouselableImagePaths.length)
					.fill(null)
					.map((_, i) => {
						return (
							<div
								className={`size-2 rounded-full first:hidden last:hidden ${index == i ? "bg-red-500" : "bg-white"}`}
							></div>
						)
					})}
			</div>
		</div>
	)
}
