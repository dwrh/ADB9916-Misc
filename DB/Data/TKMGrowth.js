var dataString ='<map borderColor="FFFFFF" connectorColor="000000" fillAlpha="70" hoverColor="FFFFFF" showBevel="1" legendPosition="bottom" bgcolor = "FFF8DC"> \n\
	<colorRange gradient="1" minValue="-5" code="FF0000" > \n\
		<color maxValue="-2.5" code="FF0000" /> \n\
		<color maxValue="0" code="FFAA00" /> \n\
	    <color maxValue="2.5" code="FFCC33" /> \n\
        <color maxValue="5" code="069F06" /> \n\
	</colorRange> \n\
<data> \n\
<entity id="TM.AL" value ="0" />\n\
<entity id="TM.BA" value ="1" />\n\
<entity id="TM.DA" value ="-4" />\n\
<entity id="TM.LE" value ="-1" />\n\
<entity id="TM.MA" value ="1" />\n\
</data> \n\
	<styles>\n\
		<definition>\n\
			<style type="animation" name="animX" param="_xscale" start="0" duration="1" />\n\
			<style type="animation" name="animY" param="_yscale" start="0" duration="1" />\n\
		</definition>	\n\
		<application>\n\
			<apply toObject="PLOT" styles="animX,animY" />\n\
		</application>\n\
	</styles>\n\
</map>';